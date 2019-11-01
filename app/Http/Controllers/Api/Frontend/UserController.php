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

    // get token
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

    public function cache()
    {
        $cache_value = \Cache::get('eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9qaXNvby50ZXN0Ojk2OTZcL2FwaVwvZnJvbnRlbmRcL3dlY2hhdFwvdG9rZW4iLCJpYXQiOjE1NzI2MTI4NTAsImV4cCI6MTU3NjIxMjg1MCwibmJmIjoxNTcyNjEyODUwLCJqdGkiOiJDc2dlWFFrT3YzdVNLTUxNIiwic3ViIjoyLCJwcnYiOiIyM2JkNWM4OTQ5ZjYwMGFkYjM5ZTcwMWM0MDA4NzJkYjdhNTk3NmY3In0.3MOIaxs-RgThKptWPUf0s9QTmRCYvmXoc3JHCvI5e_M');
        return json_decode($cache_value, true);
    }



}
