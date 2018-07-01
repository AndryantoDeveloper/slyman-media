<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Invoice;
use App\Part;

class InvoiceDetail extends Model{

	protected $table = 'invoice_detail';
    protected $fillable = [
        'invoice_id',
        'part_id',
        'price',
        'tax',
        'qty',
        'total',
    ];

    public function invoice() {
        return $this->belongsTo(Invoice::class);
    }

    public function part() {
        return $this->belongsTo(Part::class);
    }



}