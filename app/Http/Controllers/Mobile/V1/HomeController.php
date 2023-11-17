<?php

namespace App\Http\Controllers\Mobile\V1;

use App\Http\Controllers\Controller;
use App\Models\Hadith;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
        $top = Hadith::take(2)->get();

        return view('mobile.home', compact('top'));
    }
}
