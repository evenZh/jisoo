<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';

    protected $hidden = [
        'transaction_id', 'prepay_id'
    ];

    protected $casts = [
        'snap_address' => 'array',
        'snap_img' => 'array',
        'snap_name' => 'array',
        'snap_items' => 'array',
    ];



}
