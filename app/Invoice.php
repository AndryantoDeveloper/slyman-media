<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Device;
use App\Condition;
use App\InvoiceDetail;

class Invoice extends Model{

	protected $table = 'invoices';
    protected $fillable = [
        'invoice_number',
        'device_id',
        'customer_id',
        'condition_id',
        'admin_id',
        'confirmed'
    ];

    public function device() {
        return $this->belongsTo(Device::class);
    }

    public function customer() {
        return $this->belongsTo(User::class, "customer_id");
    }

     public function condition() {
        return $this->belongsTo(Condition::class);
    }

    public function admin() {
        return $this->belongsTo(User::class, "admin_id");
    }

    public function detail() {
        return $this->hasMany(InvoiceDetail::class);
    }

    public static function findBy($field, $value) {
	   return self::where($field, '=' ,$value)->get()->first();
	}

}