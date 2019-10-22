<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{
    public function getBanner($id)
    {
        $bool = IdValidator($id);
        if (!$bool) {
            return response_fail('ID参数错误');
        }

        $banner = Banner::query()->findOrFail($id);

        return response()->json($banner);
    }

    public function list()
    {
        return Banner::query()->get();
    }




}
