<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SessionFee extends Model
{
    protected $table = 'session_fee';

    protected $fillable = [
        'name',
        'details',
        'days',
        'price',
        'type',
        'gym_id',
        'branch_id'
    ];
}
