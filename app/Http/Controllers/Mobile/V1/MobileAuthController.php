<?php

namespace App\Http\Controllers\Mobile\V1;

use App\Http\Controllers\Controller;

class MobileAuthController extends Controller
{
    public function showLogin()
    {
        return view('mobile.login');
    }
}
