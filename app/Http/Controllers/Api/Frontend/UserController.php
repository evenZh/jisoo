<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\WechatToken;
use EasyWeChat\Factory;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function token()
    {
        $user = User::query()->first();
        return auth('api')->login($user);
    }

    // 获取token
    public function wechatToken(Request $request, WechatToken $wechatToken)
    {
        $this->validate($request, [
            'code' => 'required'
        ], [
            'code.*' => '请输入code'
        ]);

        $app = Factory::miniProgram(config('wechat.mini_program.default'));

        $wx_result = $app->auth->session($request->input('code'));

        if (isset($wx_result['errcode'])) {
            return response_fail('无法换取openid，检查code');
        }

        $user_token = $wechatToken->userToken($wx_result);

        return response_success($user_token);
    }



}
