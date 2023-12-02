<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Dashboard\Category\CategoryCollection;
use App\Models\Language;
use Illuminate\Support\Facades\Request;

class LanguageController extends Controller
{
    public function index(Request $request, $offset = 0, $limit = 10)
    {
        $languages = Language::query()
            ->select(
                '_id',
                'code',
                'native',
                'hadeeths_count'
            )
            ->paginate()
            ->withQueryString();

        //        if (request()->wantsJson()) {
        //            return new CategoryCollection($categories);
        //        }

        return view('dashboard.languages.index', compact('languages'));
    }

    public function create()
    {

    }
}
