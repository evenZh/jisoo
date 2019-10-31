<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
        $category_list = Category::query()
            ->with(['image'])
            ->orderBy('sort', 'desc')
            ->get();

        return response_success($category_list);
    }


}
