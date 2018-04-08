<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceProduct extends Model
{
    protected $table = 'invoice_product';

    protected $fillable = [
        'total_discount',
        'total',
        'customer_id',
        'gym_id',
        'branch_id'
    ];

    public function order_list() {
    	return $this->hasMany('App\OrderList', 'invoice_id', 'id');
    }
}
