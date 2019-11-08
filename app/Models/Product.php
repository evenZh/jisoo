<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';

    protected $hidden = [
        'pivot', 'created_at', 'updated_at'
    ];

    // 商品主图
    public function getMainImgUrlAttribute($value)
    {
        // 如果是图床图片直接返回url 否则拼接url
        if ($this->from == 2) {
            return $value;
        } else {
            return config('app.img_prefix') . $value;
        }
    }

    // 商品详情图
    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id')->orderBy('order', 'asc');
    }

    // 参数
    public function properties()
    {
        return $this->hasMany(ProductProperty::class, 'product_id', 'id');
    }

    public function decreaseStock($amount)
    {
        if ($amount < 0) {
            throw new \Exception('减库存量不能为0');
        }

        return $this->newQuery()
            ->where('id', $this->id)
            ->where('stock', '>=', $amount)
            ->decrement('stock', $amount);
    }

    public function increaseStock($amount)
    {
        if ($amount < 0) {
            throw new \Exception('加库存量不能为0');
        }

        return $this->increment('stock', $amount);
    }

}
