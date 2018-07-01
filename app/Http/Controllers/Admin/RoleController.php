<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Role;
use App\Permission;
use App\Authorizable;

class RoleController extends Controller{

	use Authorizable;

	public function index(){

		$q = \Input::get('search');
		$result = Role::where('name', 'LIKE', '%' . $q . '%')
		    ->Where('name','!=','Admin')
			->orderBy('id', 'desc')
			->paginate(10);

		$result->appends(['search' => $q]);

    	return view('admin.role.index', compact('result'));
	}

	public function create(){
		return view('admin.role.create',["permissions"=>Permission::all()]);
	}

	public function store(Request $request){
		$rules = [
            'name' => 'required|unique:roles',
            'permissions'=>'required|min:1'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        } else {
            $role = Role::create($request->only('name'));
            $permissions = $request->get('permissions', []);
            $role->syncPermissions($permissions);
            \Session::flash('message', 'Your item has been created.');
             return redirect()->route('roles.index');
        }
	}

	public function show($id){
		$roles = Role::findOrFail($id);
		return view('admin.role.show', ["data" => $roles,"permissions"=>Permission::all()]);
	}

	public function edit($id){
		$roles = Role::findOrFail($id);
		return view('admin.role.edit', ["data" => $roles,"permissions"=>Permission::all()]);
	}

	public function update(Request $request, $id){
		$role = Role::findOrFail($id);
        $permsssionRole = $role->permissions->pluck("name")->toArray();
        $rules = [
            'name' => 'required|unique:roles,name,' . $id,
            'permissions'=>'required|min:1'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        } else {
            $role->name = $request->get('name');
            $role->save();
            $permissions = $request->get('permissions', []);
            $role->syncPermissions($permissions);
            \Session::flash('message', 'Your item has been updated.');
            return redirect()->route('roles.index');
        }
	}

	public function destroy($id){
		Role::findOrFail($id)->delete();
		\Session::flash('message', 'Your item has been deleted.');
		return redirect()->route('roles.index');
	}


}