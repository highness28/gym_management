<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceMembership extends Model
{
    protected $table = 'invoice_membership';

    protected $fillable = [
        'start_date',
        'end_date',
        'customer_id',
        'plan_id',
        'discount',
        'total',
        'created_by',
        'gym_id',
        'branch_id'
    ];

    public function customer() {
        return $this->hasOne('App\Customer', 'id', 'customer_id');
    }

    public function membership_plan() {
        return $this->hasOne('App\MembershipPlan', 'id', 'plan_id');
    }
}
