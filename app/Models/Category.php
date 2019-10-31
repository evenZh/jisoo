<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function image()
    {
        return $this->belongsTo(Image::class, 'topic_img_id', 'id');
    }
}
