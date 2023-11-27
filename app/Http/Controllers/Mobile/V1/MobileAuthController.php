<?php

namespace App\Http\Controllers\Mobile\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Mobile\V1\Auth\LoginRequest;
use App\Http\Requests\Mobile\V1\Auth\RegisterRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MobileAuthController extends Controller
{
    public function showLogin()
    {
        return view('mobile.auth.login');
    }
    public function showRegister()
    {
        return view('mobile.auth.register');
    }

    public function postRegister(RegisterRequest $request)
    {
        User::create($request->validated());

        Auth::attempt($request->only('email', 'password'), true);

        // todo : send email verification email

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function postLogin(LoginRequest $request): \Illuminate\Http\RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function logout(Request $request): \Illuminate\Http\RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

}
