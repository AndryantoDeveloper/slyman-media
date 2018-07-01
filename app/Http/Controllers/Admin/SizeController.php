<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\Size;
use App\Authorizable;

class SizeController extends Controller{

	use Authorizable;

	public function index(){

		$q = \Input::get('search');
		$result = Size::where('value', 'LIKE', '%' . $q . '%')
			->orWhere('unit', 'LIKE', '%' . $q . '%')
			->orderBy('id', 'desc')
			->paginate(10);

		$result->appends(['search' => $q]);

    	return view('admin.size.index', compact('result'));
	}

	public function create(){
		return view('admin.size.create',["units"=>Size::units()]);
	}

	public function store(Request $request){
		Size::create([
			"value"=>$request->get('value'),
			"unit"=>$request->get('unit')
		]);
		\Session::flash('message', 'Your item has been saved.');
		return redirect()->route('sizes.index');
	}

	public function show($id){
		$size = Size::findOrFail($id);
		return view('admin.size.show', compact('size'));
	}

	public function edit($id){
		$size = Size::findOrFail($id);
		return view('admin.size.edit', ["data"=>$size,"units"=>Size::units()]);
	}

	public function update(Request $request, $id){
		$size = Size::findOrFail($id);
		$size->value = $request->get('value');
		$size->unit = $request->get('unit');
		$size->save();
		\Session::flash('message', 'Your item has been updated.');
		return redirect()->route('sizes.index');
	}

	public function destroy($id){
		Size::findOrFail($id)->delete();
		\Session::flash('message', 'Your item has been deleted.');
		return redirect()->route('sizes.index');
	}

}