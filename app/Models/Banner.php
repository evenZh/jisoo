<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = 'banner';

    protected $hidden = [
        'updated_at', 'created_at'
    ];

    public function items()
    {
        return $this->hasMany(BannerItem::class, 'banner_id', 'id');
    }
}
