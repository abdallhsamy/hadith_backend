<!doctype html>
<html lang="{{ app()->getLocale() }}" dir="{{ getHtmlDirection() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('general.verify_your_email') }} | {{ config('app.name') }}</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Hacen&display=swap');
    </style>
</head>
<body style="
            background-color: #007258;
            margin: 0;
            padding: 0;
            text-align: center;
            font-family: 'Hacen', sans-serif;">
<table style="width: calc(100% - 32px); height: calc(100vh - 32px); margin: 16px 16px 16px 16px; table-layout: fixed; background-color: white; border-radius: 16px">
    <tr>
        <td>
            <x-logo style="width: 100px; max-width: 80%; margin: 0 auto; "/>
{{--            <img src="{{ asset('img/email_logo.png') }}" alt="{{ config('app.name') }}" style="margin-bottom: 32px;">--}}
            <p style="margin: 0 auto 32px;
                          line-height: 32px;
                          text-align: center;">
                {{ __('general.hello') }}
                <strong>{{ $user->name }}</strong>
                <br>
                {{ __('general.you_have_registered_for_hadith_app_using') }}

                <strong>{{ $user->email }}</strong>
                <br>
                {{--                {{ __('general.to_activate_your_account_click_the_button') }}--}}
                {{ __('general.please_click_here_to_verify_your_account') }}
            </p>
            <a href="{{ route('verifyRegistrationEmail', ['user' => $user->id, 'hash' =>$user->email_verification_code]) }}" style="background-color: #007258;
                                              padding: 10px 30px;
                                              color: white;
                                              border-radius: 5px;
                                              text-decoration: none;">
                {{ __('general.confirm_registration') }}
            </a>
        </td>
    </tr>
</table>
</body>
</html>
