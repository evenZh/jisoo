<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'image';

    protected $hidden = [
        'updated_at', 'created_at', 'from', 'id'
    ];

    // 拼接图片url 读取器的使用
    public function getUrlAttribute($value)
    {
        // 如果是图床图片直接返回url 否则拼接url
        if ($this->from == 2) {
            return $value;
        } else {
            return config('app.img_prefix') . $value;
        }
    }

}
