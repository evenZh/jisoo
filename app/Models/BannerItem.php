<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerItem extends Model
{
    protected $table = 'banner_item';

    protected $hidden = [
        'updated_at', 'created_at'
    ];

    public function image()
    {
        return $this->belongsTo(Image::class, 'img_id', 'id');
    }
}
