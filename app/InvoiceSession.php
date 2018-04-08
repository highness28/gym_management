<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceSession extends Model
{
    protected $table = 'invoice_session';

    protected $fillable = [
        'start_date',
        'end_date',
        'customer_id',
        'fee_id',
        'discount',
        'total',
        'type',
        'created_by',
        'gym_id',
        'branch_id'
    ];

    public function customer() {
        return $this->hasOne('App\Customer', 'id', 'customer_id');
    }

    public function entrance_fee() {
        return $this->hasOne('App\SessionFee', 'id', 'fee_id');
    }
}
