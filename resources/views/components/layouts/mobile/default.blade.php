<!doctype html>
<html lang="{{ app()->getLocale() }}" dir="{{ getHtmlDirection() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    @stack('css')

</head>
<body>
<div class="bg-white text-gray-800 rounded-xl shadow-lg overflow-hidden relative flex" style="width:100%;height:100vh;">
    <div class="bg-white h-full w-full px-5 pt-6 pb-20 overflow-y-auto">
        <x-layouts.mobile.top-bar/>
        {{ $slot }}
    </div>
    <x-layouts.mobile.bottom-navigation-bar/>
</div>
@stack('scripts')
<x-mobile.scripts.toogle-bookmark/>
<x-mobile.scripts.session-messges/>
</body>
</html>
