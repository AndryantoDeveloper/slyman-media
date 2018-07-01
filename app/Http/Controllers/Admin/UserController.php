<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\User;
use App\Role;
use App\Authorizable;

class UserController extends Controller{

    use Authorizable;

	public function index(){

		$q = \Input::get('search');

        $result = User::where('username', 'LIKE', '%' . $q . '%')
            ->orWhere('email', 'LIKE', '%' . $q . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        $result->appends(['search' => $q]);

        return view('admin.user.index', compact('result'));
	}

	public function create(){
		return view('admin.user.create',["roles"=>Role::all()]);
	}

	public function store(Request $request){
		$rules = [
            'name' => 'required',
            'phone' => 'required',
            'username' => 'required|alpha_dash|unique:users',
            'email' => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:6',
            'roles'=>'required|min:1'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        } else {
            $newUser = new User;
            $newUser->name = $request->get("name");
            $newUser->phone = $request->get("phone");
            $newUser->username = $request->get("username");
            $newUser->email = $request->get("email");
            $newUser->password = bcrypt($request->get('password'));
            $newUser->save();
            $this->syncPermissions($request,$newUser);
            \Session::flash('message', 'Your item has been saved.');
           return redirect()->route('users.index');
        }
	}

	public function show($id){
		$user = User::findOrFail($id);
		return view('admin.user.show', compact('user'));
	}

	public function edit($id){
		$user = User::findOrFail($id);
		return view('admin.user.edit', ["data"=>$user,"roles"=>Role::all()]);
	}

	public function update(Request $request, $id){
		$rules = [
            'name' => 'required',
            'phone' => 'required',
            'username' => 'required|alpha_dash|unique:users,username,' . $id,
            'email' => 'required|email|unique:users,email,' . $id,
        ];
        if ($request->get("password")) {
            $rules["password"] = 'required|string|min:6';
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        } else {
            $editUser = User::findOrFail($id);
            $editUser->name = $request->get("name");
            $editUser->phone = $request->get("phone");
            $editUser->username = $request->get("username");
            $editUser->email = $request->get("email");
            if ($request->get("password")) {
            	$editUser->password = bcrypt($request->get('password'));
            }
            $editUser->save();
            $this->syncPermissions($request,$editUser);
            \Session::flash('message', 'Your item has been updated.');
            return redirect()->route('users.index');
        }
	}

	public function destroy($id){
		User::findOrFail($id)->delete();
        \Session::flash('message', 'Your item has been deleted.');
		return redirect()->route('usesr.index');
	}

    private function syncPermissions(Request $request, $user){
        // Get the submitted roles
        $roles = $request->get('roles', []);
        $permissions = $request->get('permissions', []);

        // Get the roles
        $roles = Role::find($roles);

        // check for current role changes
        if( ! $user->hasAllRoles( $roles ) ) {
            // reset all direct permissions for user
            $user->permissions()->sync([]);
        } else {
            // handle permissions
            $user->syncPermissions($permissions);
        }

        $user->syncRoles($roles);
        return $user;
    }


}