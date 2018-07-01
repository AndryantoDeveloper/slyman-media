<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Device;
use App\Invoice;

class Condition extends Model{

	protected $table = 'conditions';
    protected $fillable = [
        'name',
        'price',
        'link',
    ];

    public function devices() {
        return $this->belongsToMany(Device::class, "device_condition");
    }

    public function invoice() {
        return $this->hasMany(Invoice::class);
    }

    public static function findBy($field, $value) {
	   return self::where($field, '=' ,$value)->get()->first();
	}

}