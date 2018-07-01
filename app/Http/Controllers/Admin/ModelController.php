<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\Model as ModelApp;
use App\Gadget;
use App\Authorizable;

class ModelController extends Controller{

	use Authorizable;

	public function index(){

		$q = \Input::get('search');
		$result = ModelApp::where('name', 'LIKE', '%' . $q . '%')
			->orWhere('description', 'LIKE', '%' . $q . '%')
			->orderBy('id', 'desc')
			->paginate(10);

		$result->appends(['search' => $q]);

    	return view('admin.model.index', compact('result'));
	}

	public function create(){
		return view('admin.model.create',["gadgets"=>Gadget::all()]);
	}

	public function store(Request $request){
		ModelApp::create([
			"name"=>$request->get('name'),
			"gadget_id"=>$request->get('gadget_id'),
			"description"=>$request->get('description')
		]);
		\Session::flash('message', 'Your item has been saved.');
		return redirect()->route('models.index');
	}

	public function show($id){
		$model = ModelApp::findOrFail($id);
		return view('admin.model.show', compact('model'));
	}

	public function edit($id){
		$model = ModelApp::findOrFail($id);
		return view('admin.model.edit', ["data"=>$model,"gadgets"=>Gadget::all()]);
	}

	public function update(Request $request, $id){
		$model = ModelApp::findOrFail($id);
		$model->name = $request->get('name');
		$model->gadget_id = $request->get('gadget_id');
		$model->description = $request->get('description');
		$model->save();
		\Session::flash('message', 'Your item has been updated.');
		return redirect()->route('models.index');
	}

	public function destroy($id){
		ModelApp::findOrFail($id)->delete();
		\Session::flash('message', 'Your item has been deleted.');
		return redirect()->route('models.index');
	}

}