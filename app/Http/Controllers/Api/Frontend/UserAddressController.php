<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Models\UserAddress;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserAddressController extends Controller
{
    public function createOrUpdate(Request $request)
    {
        $user = auth('api')->user();

        $this->validate($request, [
            'name' => 'required|max:255',
            'phone' => 'required|regex:/^1[1234567890]\d{9}$/',
            'province' => 'required',
            'city' => 'required',
            'district' => 'required',
            'detail' => 'required|max:255',
        ], [
            'name,*' => '请输入收件人姓名',
            'phone.*' => '请输入手机号码',
            'province.*' => '请输入省',
            'city.*' => '请输入市',
            'district.*' => '请输入区',
            'detail.*' => '请输入详细地址',
        ]);

        $address_map = [
            'user_id' => $user['id'],
            'name' => $request->input('name'),
            'phone' => $request->input('phone'),
            'province' => $request->input('province'),
            'city' => $request->input('city'),
            'district' => $request->input('district'),
            'detail' => $request->input('detail'),
        ];

        if (!$user->address) {
            $address = new UserAddress();
            model_save($address, $address_map);

            return response_success();
        }

        $address = $user->address;
        model_save($address, $address_map);

        return response_success();
    }
}
