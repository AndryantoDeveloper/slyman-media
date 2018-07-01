<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Model as AppModel;
use App\Color;
use App\Size;
use App\Carrier;
use App\Condition;
use App\Part;
use App\Invoice;

class Device extends Model{

	protected $table = 'devices';
    protected $fillable = [
    	'device_id',
    	'model_id',
        'color_id',
        'size_id',
        'carrier_id',
        'price',
        'name',
        'description',
    ];

    public function model() {
        return $this->belongsTo(AppModel::class);
    }

    public function color() {
        return $this->belongsTo(Color::class);
    }

    public function size() {
        return $this->belongsTo(Size::class);
    }

    public function carrier() {
        return $this->belongsTo(Carrier::class);
    }

    public function conditions() {
        return $this->belongsToMany(Condition::class, "device_condition");
    }

    public function part() {
        return $this->hasMany(Part::class);
    }

    public function invoice() {
        return $this->hasMany(Invoice::class);
    }

    public static function findBy($field, $value) {
       return self::where($field, '=' ,$value)->get()->first();
    }

}