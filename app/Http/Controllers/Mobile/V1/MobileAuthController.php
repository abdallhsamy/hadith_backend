<?php

namespace App\Http\Controllers\Mobile\V1;

use App\Enums\UserStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Mobile\V1\Auth\ForgetPasswordRequest;
use App\Http\Requests\Mobile\V1\Auth\LoginRequest;
use App\Http\Requests\Mobile\V1\Auth\RegisterRequest;
use App\Http\Requests\Mobile\V1\Auth\UpdateProfileRequest;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MobileAuthController extends Controller
{
    public function showLogin()
    {
        return view('mobile.auth.login');
    }

    public function postLogin(LoginRequest $request): \Illuminate\Http\RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function showRegister()
    {
        return view('mobile.auth.register');
    }

    public function postRegister(RegisterRequest $request): \Illuminate\Http\RedirectResponse
    {
        User::create($request->validated());

        Auth::attempt($request->only('email', 'password'), true);

        auth()->user()->sendEmailVerificationNotification();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function verifyRegistrationEmail(User $user, string $hash)
    {
        if ($user->email_verification_code != $hash) {
            return view('mobile.auth.emails.invalid_email_verification_code', compact('user'));
        }

        if ($user->email_verified_at) {
            return view('mobile.auth.emails.already_verified', compact('user'));
        }

        $user->update([
            'email_verified_at' => date(now()),
            'status' => UserStatus::ACTIVE,
            'email_verification_code' => null,
            //            '$unset' => ['email_verification_code' => 1]
        ]);

        DB::collection('users')->where('_id', $user->id)->update([
            '$unset' => ['email_verification_code' => 1],
        ]);

        return view('mobile.auth.verified_successfully', compact('user'));
    }

    public function logout(Request $request): \Illuminate\Http\RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function profile()
    {
        $user = Auth::guard('web')->user();

        return view('mobile.profile', compact('user'));
    }

    public function updateProfile(UpdateProfileRequest $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->only('name');

        if ($request->get('email') !== auth()->user()->email) {
            $data['update_email'] = $request->get('email');
        }

        if ($request->file('avatar')) {
            $data['avatar'] = request()->file('avatar')->store(path: 'users');
        }

        auth()->user()->update($data);

        if ($request->get('email') !== auth()->user()->email) {
            // todo : send verification email

            return redirect()->route('mobile.profile')
                ->with('success', __(__('general.check_your_email')));
        }

        return redirect()->route('mobile.profile')
            ->with('success', __('general.profile_updated_successfully'));

        // todo  : make update password form
    }

    public function showForgetPassword()
    {
        return view('mobile.auth.forget_password');
    }

    public function postForgetPassword(ForgetPasswordRequest $request): \Illuminate\Http\RedirectResponse
    {
        $user = User::firstWhere($request->only('email'));

        if (! $user) {
            return redirect()->back()->withErrors([
                'email' => __('general.this_email_is_not_exists_in_our_database'),
            ]);
        }

        $user->passwordResets()->create();

        return redirect()->back()->with('success', __('general.check_your_email'));
    }

    public function showResetPassword()
    {

    }
}
