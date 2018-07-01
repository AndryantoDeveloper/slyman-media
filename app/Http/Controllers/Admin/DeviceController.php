<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;
use App\Device;
use App\Model;
use App\Color;
use App\Size;
use App\Carrier;
use App\Condition;
use App\Authorizable;

class DeviceController extends Controller{

	use Authorizable;

	public function index(){

		$q = \Input::get('search');
		$result = Device::where('name', 'LIKE', '%' . $q . '%')
			->orWhere('description', 'LIKE', '%' . $q . '%')
			->orderBy('id', 'desc')
			->paginate(10);

		$result->appends(['search' => $q]);

    	return view('admin.device.index', compact('result'));
	}

	public function create(){
		$config = array(
			"model"=>Model::all(),
			"colors"=>Color::all(),
			"sizes"=>Size::all(),
			"carriers"=>Carrier::all(),
			"conditions"=>Condition::all()
		);
		return view('admin.device.create',$config);
	}

	public function store(Request $request){
		$device = Device::create([
			"name"=>$request->get('name'),
			"model_id"=>$request->get('model_id'),
			"color_id"=>$request->get('color_id'),
			"size_id"=>$request->get('size_id'),
			"carrier_id"=>$request->get('carrier_id'),
			"description"=>$request->get('description'),
			"price"=>$request->get('price'),
		]);

		if($request->get("conditions")){
			$device->conditions()->sync($request->get("conditions"));
		}

		\Session::flash('message', 'Your item has been saved.');
		return redirect()->route('devices.index');
	}

	public function show($id){
		$device = Device::findOrFail($id);
		return view('admin.device.show', compact('device'));
	}

	public function edit($id){
		$config = array(
			"model"=>Model::all(),
			"colors"=>Color::all(),
			"sizes"=>Size::all(),
			"carriers"=>Carrier::all(),
			"data"=>Device::findOrFail($id),
			"conditions"=>Condition::all()
		);
		return view('admin.device.edit', $config);
	}

	public function update(Request $request, $id){
		$device = Device::findOrFail($id);
		$device->name = $request->get('name');
		$device->price = $request->get('price');
		$device->model_id = $request->get('model_id');
		$device->color_id = $request->get('color_id');
		$device->size_id = $request->get('size_id');
		$device->carrier_id = $request->get('carrier_id');
		$device->description = $request->get('description');
		$device->save();

		if($request->get("conditions")){
			$device->conditions()->sync($request->get("conditions"));
		}

		\Session::flash('message', 'Your item has been updated.');
		return redirect()->route('devices.index');
	}

	public function destroy($id){
		Device::findOrFail($id)->delete();
		\Session::flash('message', 'Your item has been deleted.');
		return redirect()->route('devices.index');
	}

}