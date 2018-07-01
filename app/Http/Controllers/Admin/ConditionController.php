<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\Condition;
use App\Authorizable;

class ConditionController extends Controller{

	use Authorizable;

	public function index(){

		$q = \Input::get('search');
		$result = Condition::where('name', 'LIKE', '%' . $q . '%')
			->orWhere('price', 'LIKE', '%' . $q . '%')
			->orWhere('link', 'LIKE', '%' . $q . '%')
			->orderBy('id', 'desc')
			->paginate(10);

		$result->appends(['search' => $q]);

    	return view('admin.condition.index', compact('result'));
	}

	public function create(){
		return view('admin.condition.create');
	}

	public function store(Request $request){
		Condition::create([
			"name"=>$request->get('name'),
			"price"=>$request->get('price'),
			"link"=>$request->get('link')
		]);
		\Session::flash('message', 'Your item has been saved.');
		return redirect()->route('conditions.index');
	}

	public function show($id){
		$condition = Condition::findOrFail($id);
		return view('admin.condition.show', compact('condition'));
	}

	public function edit($id){
		$condition = Condition::findOrFail($id);
		return view('admin.condition.edit', compact('condition'));
	}

	public function update(Request $request, $id){
		$condition = Condition::findOrFail($id);
		$condition->name = $request->get('name');
		$condition->price = $request->get('price');
		$condition->link = $request->get('link');
		$condition->save();
		\Session::flash('message', 'Your item has been updated.');
		return redirect()->route('conditions.index');
	}

	public function destroy($id){
		Condition::findOrFail($id)->delete();
		\Session::flash('message', 'Your item has been deleted.');
		return redirect()->route('conditions.index');
	}

}