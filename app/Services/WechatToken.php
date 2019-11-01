<?php


namespace App\Services;


use App\Models\User;

class WechatToken
{
    public function userToken($wx_result)
    {
        // 检查数据库是否有这条openid 不存在则新增user
        // 生产token写入缓存
        $user = User::query()
            ->where('open_id', $wx_result['openid'])
            ->first();

        if (!$user) {
            $user = new User();
            $user['open_id'] = $wx_result['openid'];
            $user->save();
        }

        $user_token = auth('api')->login($user);

        $cache_value = $this->makeCacheValue($wx_result, $user['id']);

        $cache_value = json_encode($cache_value);

        $expire_time = config('jwt.ttl');

        // cache
        \Cache::set($user_token, $cache_value, $expire_time * 60);

        return [
            'user_token' => $user_token
        ];
    }

    public function makeCacheValue($wx_result, $uid)
    {
        $cache_value = [];
        $cache_value['wx_result'] = $wx_result;
        $cache_value['uid'] = $uid;

        return $cache_value;
    }

}
