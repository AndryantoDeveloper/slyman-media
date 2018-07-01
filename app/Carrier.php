<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Device;

class Carrier extends Model{

	protected $table = 'carriers';
    protected $fillable = [
        'name',
        'description',
    ];

    public function device() {
        return $this->hasMany(Device::class);
    }

    public static function findBy($field, $value) {
	   return self::where($field, '=' ,$value)->get()->first();
	}

}