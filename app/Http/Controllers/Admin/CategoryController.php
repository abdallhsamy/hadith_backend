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

        return view('dashboard.categories.index', compact('categories'));
    }
}
