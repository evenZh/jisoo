<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductProperty extends Model
{
    protected $table = 'product_property';

    protected $hidden = [
        'created_at', 'updated_at'
    ];
}
