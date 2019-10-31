<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function recent()
    {
        $recent_product = Product::query()
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // 临时隐藏字段
        $recent_product->makeHidden(['summary', 'from']);

        return response_success($recent_product);
    }

    public function update()
    {
//        $products = Product::query()->get();
//
//        foreach ($products as $product) {
//            $product->created_at = now()->toDateTimeString();
//            $product->save();
//        }

        // 性能更高的批量更新
//        Product::query()->update([
//            'created_at' => now()->toDateTimeString()
//        ]);
        return response_success();
    }

    public function getAllInCategory(Request $request)
    {
        $products = Product::query()
            ->where('category_id', $request->input('id'))
            ->get();

        return response_success($products);
    }




}
