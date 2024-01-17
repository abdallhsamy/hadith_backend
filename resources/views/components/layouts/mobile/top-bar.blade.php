<div class="mb-3 flex items-center justify-between">
    <a href="{{ route('mobile.all') }}">
        <x-logo class="w-24"/>
    </a>
    <div class="flex items-center justify-between gap-2">

        <x-mobile.change-language/>

        @guest()
            <a href="{{ route('login') }}" class="text-white bg-primary px-2 py-1 rounded-lg">{{ __('general.login') }}</a>
        @endguest
        <x-mobile.sidenav/>



    </div>
</div>
