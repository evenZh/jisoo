<?php

namespace App\Http\Requests;


use App\Models\Product;

class OrderRequest extends BaseRequest
{
    public function rules()
    {
        return [
            'products' => ['required', 'array', 'min:1'],
            'products.*.product_id' => ['required', 'integer', 'min:1', function ($attribute, $value, $fail) {
                $product = Product::query()->find($value);
                if (!$product) {
                    return $fail('商品不存在');
                }
                if ($product->stock === 0) {
                    return $fail('商品无库存');
                }
                // 校验商品库存
                preg_match('/products\.(\d+)\.product_id/', $attribute, $m);
                $index = $m[1];
                // 根据索引找到用户所提交的购买数量
                $amount = $this->input('products')[$index]['count'];
                if ($amount > 0 && $amount > $product->stock) {
                    return $fail('该商品库存不足');
                }
            }],

            'products.*.count' => ['required', 'integer', 'min:1']
        ];
    }

    public function messages()
    {
        return [
            'products.required' => '缺少商品信息',
            'products.array' => '商品信息错误',
            'products.min:1' => '商品信息错误',
            'products.*.product_id.*' => '错误的商品id',
            'products.*.count.*' => '错误的商品数量'
        ];
    }


}
