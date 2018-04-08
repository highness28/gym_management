<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GymBranch extends Model
{
    protected $table = 'gym_branches';

    protected $fillable = [
        'address',
        'contact',
        'branch_type',
        'gym_id'
    ];

     public function get_gyminfo(){
        return $this->hasOne('App\GymInformation','owner_id','gym_id');
    }
}
