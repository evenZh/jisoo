<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Services\PayService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PayController extends Controller
{
    public function pay(PayService $payService)
    {

    }

    public function payByBalance(Request $request)
    {
        $this->validate($request, [
            'order_no' => 'required'
        ], [
            'order_no.*' => '缺少订单单号'
        ]);

        $result = $this->payNotify($request->input('order_no'));

        if (!$result) {
            return response_fail('支付失败');
        }

        return response_success();
    }

    public function payNotify($order_no)
    {
        \Log::info('支付回调');

        $payService = new PayService();

        $pay_result = $payService->paySuccess($order_no);

        if (!$pay_result) {
            return false;
        }

        return true;
    }


}
