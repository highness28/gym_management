<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MembershipPlan extends Model
{
    protected $table = 'membership_plan';

    protected $fillable = [
        'name',
        'details',
        'days',
        'price',
        'gym_id',
        'branch_id'
    ];
}
