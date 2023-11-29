<div class="mb-3 flex items-center justify-between">
    <a href="{{ route('mobile.all') }}">
        <x-logo class="w-24"/>
    </a>
    <div class="flex items-center justify-between gap-2">

        <x-mobile.change-language/>

        @guest()
            <a href="{{ route('login') }}" class="text-white bg-primary px-2 py-1 rounded-lg">{{ __('general.login') }}</a>
        @endguest
        @auth()
            <div id="sidenav" class="sidenav">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <a href="{{ route('mobile.profile') }}">{{ __('general.profile') }}</a>
                <a href="{{ route('mobile.about') }}">{{ __('general.about') }}</a>
                <a href="{{ route('mobile.contact') }}">{{ __('general.contact') }}</a>
                <a href="{{ route('logout') }}">{{ __('general.logout') }}</a>
            </div>

            <a href="#" onclick="openNav()" class="text-primary border border-primary px-2 py-1 rounded-lg hover:bg-primary dark:hover:text-white">{{ auth()->user()->name }}</a>
        @endauth



    </div>
</div>


@push('scripts')
    <script>
        function openNav() {
            document.getElementById("sidenav").style.width = "100%";
        }

        function closeNav() {
            document.getElementById("sidenav").style.width = "0";
        }
    </script>
@endpush
