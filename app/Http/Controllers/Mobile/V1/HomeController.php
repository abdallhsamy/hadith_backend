<?php

namespace App\Http\Controllers\Mobile\V1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Hadith;
use App\Models\Language;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
    }

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

    public function showCategoryHadiths(Request $request, Category $category)
    {
        if (
            $request->get('lang')
            && in_array($request->get('lang'), $category->languages()->pluck('code')->toArray())
        ) {
            session()->put('locale', $request->get('lang'));
            app()->setLocale($request->get('lang'));
        }

        $category->increment('views');

        $hadiths = $category->hadiths()->get();

        return view('mobile.category_hadiths', compact('category', 'hadiths'));
    }

    public function showHadith(Request $request, Hadith $hadith)
    {
        if (
            $request->get('lang')
            && in_array($request->get('lang'), $hadith->languages()->pluck('code')->toArray())
        ) {
            session()->put('locale', $request->get('lang'));
            app()->setLocale($request->get('lang'));
        }

        $hadith->increment('views');

        return view('mobile.hadith', compact('hadith'));
    }

    public function search() {
        $languages = Language::all();

//        $searchFields = [
//            'hadith',
//            'category'
//        ];

        return view('mobile.search', compact('languages'));
    }
}
