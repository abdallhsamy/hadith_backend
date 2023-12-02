
<div id="sidenav" class="public-sidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
    <a href="{{ route('mobile.profile') }}">{{ __('general.profile') }}</a>
    <a href="{{ route('mobile.about') }}">{{ __('general.about') }}</a>
    <a href="{{ route('mobile.contact') }}">{{ __('general.contact') }}</a>
    <a href="{{ route('logout') }}">{{ __('general.logout') }}</a>
</div>

<a href="#" onclick="openNav()" class="text-primary border border-primary px-2 py-1 rounded-lg hover:bg-primary dark:hover:text-white">{{ auth()->user()->name }}</a>


@once
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

@endonce
