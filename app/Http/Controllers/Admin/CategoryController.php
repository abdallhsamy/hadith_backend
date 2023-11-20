<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\Category\CategoryCollection;
use App\Models\Category;
use Illuminate\Support\Facades\Request;

class CategoryController extends Controller
{
    public function index(Request $request, $offset = 0, $limit = 10)
    {
        $categories = Category::query()
            ->select(
                '_id',
                'id',
                'title',
                'hadeeths_count'
            )
            ->get();

        if (request()->wantsJson()) {
            return new CategoryCollection($categories);
        }

        return view('dashboard.categories.index', compact('categories'));
    }
}
