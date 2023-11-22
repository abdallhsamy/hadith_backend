<?php

namespace App\Http\Controllers\Mobile\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Hadith;

class HomeController extends Controller
{
    public function today()
    {

        //        return Language::pluck('code');
        //        foreach (Hadith::all() as $item ) {
        //            $cats = Category::whereIn('id', $item->categories)->get();
        //            if (count($item->categories) > 0) {
        ////                return response()->json($cats);
        //                $item->categoriesRel()->attach($cats);
        //
        //            }
        //
        //        }
        $today = Hadith::query()
            ->select('*')->take(4)->get();
        $yesterday = Hadith::query()
            ->select('*')->skip(4)->take(4)->get();
        $old = Hadith::query()
            ->select('*')->skip(4)->take(4)->get();

        //        foreach ($top as $t) {
        //            return $t->translation();
        //        }

        //        return response()->json($top);
        //        dd($top);

        return view('mobile.today', compact('today', 'yesterday', 'old'));
    }

    public function all()
    {
        $hadiths = Hadith::query()
            ->select('*')
            ->paginate()
            ->withQueryString();

        return view('mobile.all', compact('hadiths'));
    }

    public function categories()
    {
        $categories = Category::query()
            ->whereNotNull('hadiths_count')
            ->whereNot('hadiths_count', 0)
            ->select('*')
//            ->paginate()
//            ->withQueryString();
            ->get();

        return view('mobile.categories', compact('categories'));
    }

    public function showCategoryHadiths(Category $category)
    {
        $category->increment('views');

        $hadiths = $category->hadiths()->get();

        return view('mobile.category_hadiths', compact('category', 'hadiths'));
    }

    public function showHadith(Hadith $hadith)
    {
        $hadith->increment('views');

        return view('mobile.hadith', compact('hadith'));
    }
}
