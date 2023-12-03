<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hadith;
use Illuminate\Support\Facades\Request;

class HadithController extends Controller
{
    public function index(Request $request, $offset = 0, $limit = 10)
    {
        $hadiths = Hadith::query()
            ->select(
                '_id',
                'title',
                'grade',
                'translations',
                'views',
            )
            ->paginate()
            ->withQueryString();

        return view('dashboard.hadiths.index', compact('hadiths'));
    }

    public function create()
    {

    }
}
