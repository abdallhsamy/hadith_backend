<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::query()
            ->select('*')
            ->paginate()
            ->withQueryString();

        if (request()->wantsJson()) {
//            return response()->json($categories);
            return response()->json($categories->map(function (Category $category) {
                return [
                    '_id' => $category->_id,
                    'id' => $category->id,
                    'title' => $category->translation()->title,
                    'hadeeths_count' => $category->hadeeths_count,
                ];
            }));
        }

        return view('dashboard.categories.index', compact('categories'));
    }
}
