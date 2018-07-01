<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Gadget;

class Brand extends Model{

	protected $table = 'brands';
    protected $fillable = [
        'name',
        'description',
    ];

    public function gadget() {
        return $this->hasMany(Gadget::class);
    }

    public static function findBy($field, $value) {
	   return self::where($field, '=' ,$value)->get()->first();
	}

}