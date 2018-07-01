<?php

namespace App;

use Illuminate\Database\Eloquent\Model as BaseModel;
use App\Gadget;
use App\Device;


class Model extends BaseModel{

	protected $table = 'models';
    protected $fillable = [
        'name',
        'gadget_id',
        'description',
    ];

    public function gadget() {
        return $this->belongsTo(Gadget::class);
    }

    public function device() {
        return $this->hasMany(Device::class);
    }

    public static function findBy($field, $value) {
       return self::where($field, '=' ,$value)->get()->first();
    }

    
}