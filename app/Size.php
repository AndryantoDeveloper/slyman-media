<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Device;

class Size extends Model{

	protected $table = 'sizes';
    protected $fillable = [
        'value',
        'unit',
    ];

    public static function units(){
	    return [
	    	"KB"=>"KB",
	    	"MB"=>"MB",
	    	"GB"=>"GB",
	    	"TB"=>"TB"
	    ];
	}


	public function device() {
        return $this->hasMany(Device::class);
    }

    
    public static function findBy($field, $value) {
       return self::where($field, '=' ,$value)->get()->first();
    }

}