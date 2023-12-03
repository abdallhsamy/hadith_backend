<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Hadith;
use App\Models\Language;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $hadithCount = Hadith::query()->count();
        $languageCount = Language::query()->count();
        $categoryCount = Category::query()->count();
        $commentCount = Comment::query()->count();
        $userCount = User::query()->count();

        return view('dashboard.index', compact('hadithCount', 'languageCount', 'categoryCount', 'commentCount', 'userCount'));
    }
}
