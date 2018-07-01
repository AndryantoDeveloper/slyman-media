<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\Carrier;
use App\Authorizable;

class CarrierController extends Controller{

	use Authorizable;

	public function index(){

		$q = \Input::get('search');
		$result = Carrier::where('name', 'LIKE', '%' . $q . '%')
			->orWhere('description', 'LIKE', '%' . $q . '%')
			->orderBy('id', 'desc')
			->paginate(10);

		$result->appends(['search' => $q]);

    	return view('admin.carrier.index', compact('result'));
	}

	public function create(){
		return view('admin.carrier.create');
	}

	public function store(Request $request){
		Carrier::create([
			"name"=>$request->get('name'),
			"description"=>$request->get('description')
		]);
		\Session::flash('message', 'Your item has been saved.');
		return redirect()->route('carriers.index');
	}

	public function show($id){
		$carrier = Carrier::findOrFail($id);
		return view('admin.carrier.show', compact('carrier'));
	}

	public function edit($id){
		$carrier = Carrier::findOrFail($id);
		return view('admin.carrier.edit', compact('carrier'));
	}

	public function update(Request $request, $id){
		$carrier = Carrier::findOrFail($id);
		$carrier->name = $request->get('name');
		$carrier->description = $request->get('description');
		$carrier->save();
		\Session::flash('message', 'Your item has been updated.');
		return redirect()->route('carriers.index');
	}

	public function destroy($id){
		Carrier::findOrFail($id)->delete();
		\Session::flash('message', 'Your item has been deleted.');
		return redirect()->route('carriers.index');
	}

}