<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GymService extends Model
{
    protected $table = 'gym_services';

    protected $fillable = [
        'name',
        'original_price',
        'succeeding_price',
        'hours',
        'details',
        'gym_information_id'
    ];
}
