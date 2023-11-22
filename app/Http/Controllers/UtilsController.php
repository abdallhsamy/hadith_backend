<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;

class UtilsController extends Controller
{
    public function changeLanguage(Request $request, $locale = 'ar')
    {
        app()->setLocale($locale);
        session()->put('locale', $locale);

        return response()->noContent();
    }
}
