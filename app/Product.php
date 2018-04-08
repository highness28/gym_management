<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';

    protected $fillable = [
        'product_name',
        'selling_price',
        'details',
        'unit_price',
        'critical_highest',
        'critical_lowest',
        'quantity',
        'image',
        'brand_id',
        'sub_category_id',
        'main_category_id',
        'gym_id',
        'branch_id'
    ];

    public function brand() {
        return $this->hasOne('App\Brand', 'id', 'brand_id');
    }

    public function main_category() {
        return $this->hasOne('App\MainCategory', 'id', 'main_category_id');
    }

    public function sub_category() {
        return $this->hasOne('App\SubCategory', 'id', 'sub_category_id');
    }
}
