<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\Part;
use App\Device;
use App\Authorizable;

class PartController extends Controller{

	use Authorizable;

	public function index(){

		$q = \Input::get('search');
		$result = Part::where('name', 'LIKE', '%' . $q . '%')
			->orWhere('description', 'LIKE', '%' . $q . '%')
			->orderBy('id', 'desc')
			->paginate(10);

		$result->appends(['search' => $q]);

    	return view('admin.part.index', compact('result'));
	}

	public function create(){
		return view('admin.part.create',["device"=>Device::all()]);
	}

	public function store(Request $request){
		Part::create([
			"name"=>$request->get('name'),
			"price"=>$request->get('price'),
			"tax"=>$request->get('tax'),
			"stock"=>$request->get('stock'),
			"device_id"=>$request->get('device_id'),
			"description"=>$request->get('description')
		]);
		\Session::flash('message', 'Your item has been saved.');
		return redirect()->route('parts.index');
	}

	public function show($id){
		$part = Part::findOrFail($id);
		return view('admin.part.show', compact('part'));
	}

	public function edit($id){
		$part = Part::findOrFail($id);
		return view('admin.part.edit', ["data"=>$part,"device"=>Device::all()]);
	}

	public function update(Request $request, $id){
		$part = Part::findOrFail($id);
		$part->name = $request->get('name');
		$part->price = $request->get('price');
		$part->tax = $request->get('tax');
		$part->stock = $request->get('stock');
		$part->device_id = $request->get('device_id');
		$part->description = $request->get('description');
		$part->save();
		\Session::flash('message', 'Your item has been updated.');
		return redirect()->route('parts.index');
	}

	public function destroy($id){
		Part::findOrFail($id)->delete();
		\Session::flash('message', 'Your item has been deleted.');
		return redirect()->route('parts.index');
	}

}