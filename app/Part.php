<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Device;
use App\InvoiceDetail;

class Part extends Model{

	protected $table = 'parts';
    protected $fillable = [
        'name',
        'price',
        'tax',
        'stock',
        'device_id',
        'description',
    ];

    public function device() {
        return $this->belongsTo(Device::class);
    }

    public function detail() {
        return $this->hasMany(InvoiceDetail::class);
    }

    public static function findBy($field, $value) {
       return self::where($field, '=' ,$value)->get()->first();
    }


}