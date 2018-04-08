<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CustomerLog extends Model
{
    protected $table = 'customer_log';

    protected $fillable = [
        'date',
        'start_time',
        'end_time',
        'customer_id'
    ];
}
