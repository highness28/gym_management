<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderList extends Model
{
    protected $table = 'order_list';

    protected $fillable = [
        'quantity',
        'discount',
        'sub_total',
        'product_id',
        'invoice_id',
        'gym_id',
        'branch_id'
    ];

    public function product() {
    	return $this->hasOne('App\Product', 'id', 'product_id');
    }
}
