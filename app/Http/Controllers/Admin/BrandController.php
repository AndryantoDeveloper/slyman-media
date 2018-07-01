<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\Brand;
use App\Authorizable;

class BrandController extends Controller{

	use Authorizable;

	public function index(){

		$q = \Input::get('search');
		$result = Brand::where('name', 'LIKE', '%' . $q . '%')
			->orWhere('description', 'LIKE', '%' . $q . '%')
			->orderBy('id', 'desc')
			->paginate(10);

		$result->appends(['search' => $q]);

    	return view('admin.brand.index', compact('result'));
	}

	public function create(){
		return view('admin.brand.create');
	}

	public function store(Request $request){
		Brand::create([
			"name"=>$request->get('name'),
			"description"=>$request->get('description')
		]);
		\Session::flash('message', 'Your item has been saved.');
		return redirect()->route('brands.index');
	}

	public function show($id){
		$brand = Brand::findOrFail($id);
		return view('admin.brand.show', compact('brand'));
	}

	public function edit($id){
		$brand = Brand::findOrFail($id);
		return view('admin.brand.edit', compact('brand'));
	}

	public function update(Request $request, $id){
		$brand = Brand::findOrFail($id);
		$brand->name = $request->get('name');
		$brand->description = $request->get('description');
		$brand->save();
		\Session::flash('message', 'Your item has been updated.');
		return redirect()->route('brands.index');
	}

	public function destroy($id){
		Brand::findOrFail($id)->delete();
		\Session::flash('message', 'Your item has been deleted.');
		return redirect()->route('brands.index');
	}

}