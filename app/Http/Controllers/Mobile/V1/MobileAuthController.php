<?php

namespace App\Http\Controllers\Mobile\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mobile\V1\Search\SearchRequest;
use App\Models\Category;
use App\Models\Hadith;
use App\Models\Language;
use Illuminate\Http\Request;

class MobileAuthController extends Controller
{
    public function showLogin()
    {
        return view('mobile.login');
    }
}
