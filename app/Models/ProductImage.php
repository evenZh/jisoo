<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_image';

    protected $hidden = [
        'created_at', 'updated_at', 'img_id', 'id'
    ];

    public function image()
    {
        return $this->belongsTo(Image::class, 'img_id', 'id');
    }
}
