<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Brand;
use App\Model as ModelApp;

class Gadget extends Model{

	protected $table = 'gadgets';
    protected $fillable = [
    	'gadget_id',
    	'brand_id',
        'name',
        'description',
    ];

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function model() {
        return $this->hasMany(ModelApp::class);
    }

    public static function findBy($field, $value) {
       return self::where($field, '=' ,$value)->get()->first();
    }

}