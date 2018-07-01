<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Device;

class Color extends Model{

	protected $table = 'colors';
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