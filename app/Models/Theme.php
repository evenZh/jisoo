<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $table = 'theme';

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function topicImage()
    {
        return $this->belongsTo(Image::class, 'topic_img_id', 'id');
    }

    public function headImage()
    {
        return $this->belongsTo(Image::class, 'head_img_id', 'id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'theme_product', 'theme_id', 'product_id');
    }
}
