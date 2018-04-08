<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceService extends Model
{
    protected $table = 'invoice_services';

    protected $fillable = [
        'date',
        'hours_used',
        'discount',
        'total',
        'customer_id',
        'gym_services_id'
    ];
}
