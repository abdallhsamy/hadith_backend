<div class="mb-3 flex items-center justify-between">
    <x-logo class="w-24"/>
    @guest()
        <a href="{{ route('login') }}" class="text-white bg-primary px-2 py-1 rounded-lg">{{ __('general.login') }}</a>
    @endguest
    @auth()
        <a href="#" class="text-primary border border-primary px-2 py-1 rounded-lg hover:bg-primary dark:hover:text-white">{{ auth()->user()->name }}</a>
    @endauth
</div>
