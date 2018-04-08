<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customer';

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'birthdate',
        'email_address',
        'home_address',
        'contact_number',
        'image',
        'slug',
        'gym_id',
        'branch_id',
    ];

    public function branch() {
        return $this->hasOne('App\GymBranch', 'id', 'branch_id');
    }
}
