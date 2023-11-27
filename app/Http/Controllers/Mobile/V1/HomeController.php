<?php

namespace App\Http\Controllers\Mobile\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mobile\V1\Search\SearchRequest;
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

    public function bookmark(Request $request, Hadith $hadith)
    {
        if (in_array($hadith->_id, auth()->user()->favoriteHadiths()->pluck('_id')->toArray(), true)) {
            auth()->user()->favoriteHadiths()->detach($hadith);
            $message = 'bookmarked_successfully';
            $bookmarked = false;
        } else {
            auth()->user()->favoriteHadiths()->attach($hadith);
            $message = 'un_bookmarked_successfully';
            $bookmarked = true;
        }
        $id =  $hadith->_id;

        return response()->json(compact('id', 'message', 'bookmarked'));
    }

    public function search() {
        $languages = Language::all();
        $query = old('query');
        $language = app()->getLocale();

        return view('mobile.search', compact('languages', 'query', 'language'));
    }

    public function postSearch(SearchRequest $request) {

        $language = $request->get('language');
        $query = $request->get('query');
        $languages = Language::all();

        $results = Hadith::query()
            ->where("hadeeth.$language", 'like', "%{$query}%")
            ->get();

        return view('mobile.search', compact('languages', 'results', 'query', 'language'));
    }



    public function favorites()
    {
//        $hadiths = Hadith::query()
//            ->select('*')
//            ->paginate()
//            ->withQueryString();

        $hadiths = auth()->user()->favoriteHadiths()
            ->select('*')
            ->paginate()
            ->withQueryString();

        return view('mobile.favorites', compact('hadiths'));
    }
}
