<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function list()
    {
        return 111;

    }

    public function token()
    {
        $user = User::query()->first();
        return auth('api')->login($user);
    }

    public function update()
    {
        User::query()
            ->where('id', 1)
            ->update([
                'open_id' => 123456,
                'nickname' => 'jisoo'
            ]);

        return response_success();
    }
}
