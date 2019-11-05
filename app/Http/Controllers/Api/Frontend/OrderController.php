<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\UserAddress;
use App\Services\OrderService;

class OrderController extends Controller
{
    public function create(OrderRequest $orderRequest, OrderService $orderService)
    {
        $user = auth('api')->user();

        $user_address = UserAddress::query()
            ->where('user_id', $user['id'])
            ->first();

        $full_address = $user_address->full_address;

        $address = [
            'name' => $user_address['name'],
            'phone' => $user_address['phone'],
            'full_address' => $full_address
        ];

        $order_products = $orderRequest->input('products');

        try {
            $order = $orderService->createOrder($user, $order_products, $address);
        } catch (\Exception $exception) {
            return response_fail($exception->getMessage());
        }

        return $order;
    }


}
