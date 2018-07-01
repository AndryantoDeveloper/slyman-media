<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\model;
use App\Condition;
use App\Carrier;
use App\Size;
use App\Color;
use App\Model as AppModel;
use App\Device;
use App\Invoice;

class SellController extends Controller
{
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('sell.index',["model"=>AppModel::orderBy('name','asc')->get()]);
    }

    public function store(Request $request){
       Invoice::create([
            "invoice_number"=>md5(time()),
            "device_id"=>$request->get('device_id'),
            "condition_id"=>$request->get('condition_id'),
            "customer_id"=>\Auth::User()->id
       ]); 
       \Session::flash('message', 'Your invoice has been requested. Please wait for confirmation.');
       return redirect()->route('sells.index');
    }

    public function byColor($id){
        
        $model = AppModel::findOrFail($id);
        $colorByModel = Device::Where('model_id',$id)->pluck("color_id")->toArray();

    	$config = array(
    		"color"=>Color::WhereIn('id',$colorByModel)->orderBy('name','asc')->get(),
    		"model_id"=>$id,
            "model_name"=>$model->name,
    	);
    	return view('sell.color',$config);
    }

    public function byNetwork($model_id, $color_id){
        $color = Color::findOrFail($color_id);
        $model = AppModel::findOrFail($model_id);

        $networkByModel = Device::Where('model_id','=',$model_id)
            ->Where('color_id',$color_id)
            ->pluck('carrier_id')
            ->toArray();
        

        $config = array(
            "carrier"=>Carrier::WhereIn('id',$networkByModel)->orderBy('name','asc')->get(),
            'color_name'=>$color->name,
            "model_id"=>$model->id,
            "model_name"=>$model->name,
            "color_id"=>$color->id
        );
        return view('sell.network',$config);
    }

    public function bySize($model_id, $color_id, $carrier_id){
        $color = Color::findOrFail($color_id);
        $model = AppModel::findOrFail($model_id);
        $carrier = Carrier::findOrFail($carrier_id);
       
        $sizeByModel = Device::Where('model_id','=',$model_id)
            ->Where('color_id',$color_id)
            ->Where('carrier_id',$carrier_id)
            ->pluck('size_id')
            ->toArray();


        $config = array(
            "size"=>Size::WhereIn('id',$sizeByModel)->orderBy('value','asc')->get(),
            "model_id"=>$model->id,
            "model_name"=>$model->name,
            "color_id"=>$color->id,
            "color_name"=>$color->name,
            "carrier_id"=>$carrier->id,
            "carrier_name"=>$carrier->name
        );


        return view('sell.size',$config);
    }

    public function byCondition($model_id, $color_id, $carrier_id, $size_id){

        $color = Color::findOrFail($color_id);
        $model = AppModel::findOrFail($model_id);
        $carrier = Carrier::findOrFail($carrier_id);
        $size = Size::findOrFail($size_id);
         
        $conditionByModel = Device::Where('model_id','=',$model_id)
            ->Where('color_id',$color_id)
            ->Where('carrier_id',$carrier_id)
            ->Where('size_id',$size_id)
            ->distinct()
            ->join('device_condition', function($join) {
                $join->on('device_condition.device_id', '=', 'devices.id');
            })
            ->pluck('device_condition.condition_id')
            ->toArray();

         $config = array(
            "condition"=>Condition::WhereIn('id',$conditionByModel)->orderBy('name','asc')->get(),
            "model_id"=>$model->id,
            "model_name"=>$model->name,
            "color_id"=>$color->id,
            "color_name"=>$color->name,
            "carrier_id"=>$carrier->id,
            "carrier_name"=>$carrier->name,
            "size_id"=>$size->id,
            "size_name"=>$size->value.' '.$size->unit
        );
        return view('sell.condition',$config);
    }

    public function checkout($model_id, $color_id, $carrier_id, $size_id,$condition_id){
        
        $condition = Condition::findOrFail($condition_id);
        $device = Device::Where('devices.model_id','=',$model_id)
            ->Where('devices.color_id',$color_id)
            ->Where('devices.carrier_id',$carrier_id)
            ->Where('devices.size_id',$size_id)
            ->Where('device_condition.condition_id',$condition_id)
            ->distinct()
            ->join('device_condition', function($join) {
                $join->on('device_condition.device_id', '=', 'devices.id');
            })
            ->first();

        if(!$device){
            return redirect()->route('ordersells.condition',[
                'model_id'=>$model_id,
                'color_id'=>$color_id,
                'carrier_id'=>$carrier_id,
                'size_id'=>$size_id
            ]);
        }

        $config  = array(
            "model_id"=>$device->model->id,
            "model_name"=>$device->model->name,
            "color_id"=>$device->color->id,
            "color_name"=>$device->color->name,
            "carrier_id"=>$device->carrier->id,
            "carrier_name"=>$device->carrier->name,
            "size_id"=>$device->size->id,
            "size_name"=>$device->size->value.' '.$device->size->unit,
            "condition_id"=>$condition->id,
            "condition_name"=>$condition->name,
            "price"=>$condition->price,
            "device_id"=>$device->id
        );
        return view('sell.checkout',$config);
    }

}
