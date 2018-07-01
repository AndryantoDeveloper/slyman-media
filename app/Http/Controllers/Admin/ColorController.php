<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\Color;
use App\Authorizable;

class ColorController extends Controller{

	use Authorizable;

	public function index(){

		$q = \Input::get('search');
		$result = Color::where('name', 'LIKE', '%' . $q . '%')
			->orWhere('description', 'LIKE', '%' . $q . '%')
			->orderBy('id', 'desc')
			->paginate(10);

		$result->appends(['search' => $q]);

    	return view('admin.color.index', compact('result'));
	}

	public function create(){
		return view('admin.color.create');
	}

	public function store(Request $request){
		Color::create([
			"name"=>$request->get('name'),
			"description"=>$request->get('description')
		]);
		\Session::flash('message', 'Your item has been saved.');
		return redirect()->route('colors.index');
	}

	public function show($id){
		$color = Color::findOrFail($id);
		return view('admin.color.show', compact('color'));
	}

	public function edit($id){
		$color = Color::findOrFail($id);
		return view('admin.color.edit', compact('color'));
	}

	public function update(Request $request, $id){
		$color = Color::findOrFail($id);
		$color->name = $request->get('name');
		$color->description = $request->get('description');
		$color->save();
		\Session::flash('message', 'Your item has been updated.');
		return redirect()->route('colors.index');
	}

	public function destroy($id){
		Color::findOrFail($id)->delete();
		\Session::flash('message', 'Your item has been deleted.');
		return redirect()->route('colors.index');
	}

}