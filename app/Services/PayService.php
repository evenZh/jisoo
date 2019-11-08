<?php


namespace App\Services;



use App\Models\Order;
use EasyWeChat\Factory;

class PayService
{
    public function wxMiniPay($order_no, $price, $body = null, $openid)
    {
        $app = Factory::payment(config('wechat.payment.wx_mini'));

        $result = $app->order->unify([
            'body' => $body,
            'out_trade_no' => $order_no,
            // 'total_fee' => $price * 100,
            'total_fee' => 0.01 * 100,
            'trade_type' => 'JSAPI',
            'openid' => $openid
        ]);

        if ($result['return_code'] != 'SUCCESS' || $result['result_code'] != 'SUCCESS') {
            \Log::info($result);
            return response_fail('订单创建失败');
        }

        $result = $app->jssdk->bridgeConfig($result['prepay_id'], false);
        return $result;
    }

    public function paySuccess($order_no)
    {
        $order = Order::query()
            ->where('order_no', $order_no)
            ->firstOrFail();

        $success_num = Order::query()
            ->where('id', $order['id'])
            ->whereNull('pay_datetime')
            ->update([
                'status' => 2,
                'pay_datetime' => now()->toDateTimeString()
            ]);

        if ($success_num <= 0) {
            return false;
        }

        return true;
    }

}
