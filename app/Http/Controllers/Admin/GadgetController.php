<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\Gadget;
use App\Brand;
use App\Authorizable;

class GadgetController extends Controller{

	use Authorizable;

	public function index(){

		$q = \Input::get('search');
		$result = Gadget::where('name', 'LIKE', '%' . $q . '%')
			->orWhere('description', 'LIKE', '%' . $q . '%')
			->orderBy('id', 'desc')
			->paginate(10);

		$result->appends(['search' => $q]);

    	return view('admin.gadget.index', compact('result'));
	}

	public function create(){
		return view('admin.gadget.create',["brands"=>Brand::all()]);
	}

	public function store(Request $request){
		Gadget::create([
			"name"=>$request->get('name'),
			"brand_id"=>$request->get('brand_id'),
			"description"=>$request->get('description')
		]);
		\Session::flash('message', 'Your item has been saved.');
		return redirect()->route('gadgets.index');
	}

	public function show($id){
		$gadget = Gadget::findOrFail($id);
		return view('admin.gadget.show', compact('gadget'));
	}

	public function edit($id){
		$gadget = Gadget::findOrFail($id);
		return view('admin.gadget.edit', ["data"=>$gadget,"brands"=>Brand::all()]);
	}

	public function update(Request $request, $id){
		$gadget = Gadget::findOrFail($id);
		$gadget->name = $request->get('name');
		$gadget->brand_id = $request->get('brand_id');
		$gadget->description = $request->get('description');
		$gadget->save();
		\Session::flash('message', 'Your item has been updated.');
		return redirect()->route('gadgets.index');
	}

	public function destroy($id){
		Gadget::findOrFail($id)->delete();
		\Session::flash('message', 'Your item has been deleted.');
		return redirect()->route('gadgets.index');
	}

}