<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = 'inventory';

    protected $fillable = [
        'quantity',
        'stockout_quantity',
        'unit_price',
        'remarks',
        'product_id',
        'supplier_id',
        'gym_id',
        'branch_id'
    ];

    public function product(){
        return $this->hasOne('App\Product','id','product_id');
    }

    public function supplier(){
        return $this->hasOne('App\Supplier','id','supplier_id');
    }
}