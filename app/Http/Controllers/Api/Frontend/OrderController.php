<?php

namespace App\Http\Controllers\Api\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    public function myOrders()
    {

    }

    public function create(Request $request)
    {
        $this->validate($request, [
            'products' => 'required|array|min:1'

        ], [
            'products.*' => '商品信息错误'
        ]);

        $products = $request->input('products');

        foreach ($products as $product) {
            $validator = \Validator::make($product, [

            ], [

            ]);
            if ($validator->fails()) {

            }
        }

    }


}
