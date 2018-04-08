<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    protected $table = 'main_category';

    protected $fillable = [
        'main_name',
        'gym_id'
    ];
}
