<?php


namespace App\Services;



use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use DB;

class OrderService
{
    public function createOrder($user, $order_products, $address)
    {
        $order_no = date('YmdHis') . mt_rand(111111, 999999) . get_rand_number();
        $total_price = 0;
        $snap_items = [];

        foreach ($order_products as $key => $order_product) {
            $product = Product::query()
                ->find($order_product['product_id']);
            $price = $product['price'] * $order_product['count'];
            $total_price += $price;
            $snap_items[] = $product;

            if ($key == 0) {
                $snap_name = $product['name'];
                $snap_img = $product['main_img_url'];
            }
        }

        if (count($order_products) > 1) {
            $snap_name .= '等';
        }

        DB::beginTransaction();

        try {
            $order_map = [
                'order_no' => $order_no,
                'user_id' => $user['id'],
                'total_price' => $total_price,
                'snap_address' => $address,
                'snap_items' => $snap_items,
                'snap_name' => $snap_name,
                'snap_img' => $snap_img
            ];

            $order = model_save(new Order(), $order_map);

            $order_product_map = [];

            foreach ($order_products as $order_product) {
                $num = Product::query()
                    ->where('id', $order_product['product_id'])
                    ->decrement('stock', $order_product['count']);

                if ($num <= 0) {
                    throw new \Exception('系统异常');
                }

                $order_product_map[] = [
                    'order_id' => $order['id'],
                    'product_id' => $order_product['product_id'],
                    'count' => $order_product['count'],
                    'created_at' => $order['created_at']
                ];
            }
            OrderProduct::query()->insert($order_product_map);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            \Log::error($exception->getMessage());
            throw new \Exception('系统异常');
        }

        return $order;
    }

}
