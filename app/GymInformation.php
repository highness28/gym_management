<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GymInformation extends Model
{
	protected $table = 'gym_information';

    protected $fillable = [
        'name',
        'owner_id',
        'logo',
        'others'
    ];
    
    public function get_gymbranch(){
        return $this->hasOne('App\GymBranch','gym_id','id');
    }

    public function productBrands() {
        return $this->hasMany('App\Brand', 'gym_id', 'id');
    }

    public function mainCategories() {
        return $this->hasMany('App\MainCategory', 'gym_id', 'id');
    }

    public function subCategories() {
        return $this->hasMany('App\SubCategory', 'gym_id', 'id');
    }
}
