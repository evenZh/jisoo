<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Models\Theme;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ThemeController extends Controller
{
    public function index()
    {
        $theme_list = Theme::query()
            ->with(['topicImage', 'headImage'])
            ->get();

        return response_success($theme_list);
    }


    public function detail(Request $request)
    {
        $theme = Theme::query()
            ->with(['products', 'topicImage', 'headImage'])
            ->find($request->input('id'));

        return response_success($theme);
    }




}
