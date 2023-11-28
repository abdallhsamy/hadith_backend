<?php

namespace App\Http\Controllers\Mobile\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mobile\V1\Search\SearchRequest;
use App\Models\Category;
use App\Models\DailySelectedHadith;
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
        $today = DailySelectedHadith::getHadiths();
        $yesterday = DailySelectedHadith::getHadiths(1);
        $old = DailySelectedHadith::getHadiths(2);

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
        if (in_array($hadith->_id, auth()->user()->bookmarkedHadiths()->pluck('_id')->toArray(), true)) {
            auth()->user()->bookmarkedHadiths()->detach($hadith);
            $message = __('general.un_bookmarked_successfully');
            $bookmarked = false;
        } else {
            auth()->user()->bookmarkedHadiths()->attach($hadith);
            $message = __('general.bookmarked_successfully');
            $bookmarked = true;
        }
        $id = $hadith->_id;

        return response()->json(compact('id', 'message', 'bookmarked'));
    }

    public function search()
    {
        $languages = Language::all();
        $query = old('query');
        $language = app()->getLocale();

        return view('mobile.search', compact('languages', 'query', 'language'));
    }

    public function postSearch(SearchRequest $request)
    {

        $language = $request->get('language');
        $query = $request->get('query');
        $languages = Language::all();

        $results = Hadith::query()
            ->where("hadeeth.$language", 'like', "%{$query}%")
            ->get();

        return view('mobile.search', compact('languages', 'results', 'query', 'language'));
    }

    public function bookmarks()
    {
        //        $hadiths = Hadith::query()
        //            ->select('*')
        //            ->paginate()
        //            ->withQueryString();

        $hadiths = auth()->user()->bookmarkedHadiths()
            ->select('*')
            ->paginate()
            ->withQueryString();

        return view('mobile.bookmarks', compact('hadiths'));
    }

    public function about()
    {
        return view('mobile.about');
    }
}
