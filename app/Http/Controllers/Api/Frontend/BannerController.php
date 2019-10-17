<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Models\Banner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{
    public function getBanner($id)
    {
        $banner = Banner::query()->findOrFail($id);

        return response()->json($banner);
    }
}
