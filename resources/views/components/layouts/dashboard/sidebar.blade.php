<div class="sidenav h-screen w-60 ms-4 overflow-x-hidden relative">
    <x-logo color="white" class="ms-8 me-12 mt-4"/>
    <hr class="border-shade my-4 me-4">
    <ul class=" flex flex-col ">
        @php
            $items = [
                (object) [
                    'title' => __('general.dashboard'),
                    'url' => route('dashboard.index'),
                    'icon' => '<i data-feather="anchor"></i>'
                ],
                (object) [
                    'title' => __('general.languages'),
                    'url' => route('dashboard.languages.index'),
                    'icon' => '<i data-feather="globe"></i>'
                ],
                (object) [
                    'title' => __('general.categories'),
                    'url' => route('dashboard.categories.index'),
                    'icon' => '<i data-feather="archive"></i>'
                ],
                (object) [
                    'title' => __('general.hadith_list'),
                    'url' => '#',
                    'icon' => '<i data-feather="file-text"></i>'
                ],
                (object) [
                    'title' => __('general.searches'),
                    'url' => '#',
                    'icon' => '<i data-feather="search"></i>'
                ],
                (object) [
                    'title' => __('general.settings'),
                    'url' => '#',
                    'icon' => '<i data-feather="settings"></i>'
                ],
                (object) [
                    'title' => __('general.profile'),
                    'url' => '#',
                    'icon' => '<i data-feather="user"></i>'
                ],
                (object) [
                    'title' => __('general.users'),
                    'url' => '#',
                    'icon' => '<i data-feather="users"></i>'
                ],
                (object) [
                    'title' => __('general.comments'),
                    'url' => '#',
                    'icon' => '<i data-feather="message-square"></i>'
                ],
                (object) [
                    'title' => __('general.statistics'),
                    'url' => '#',
                    'icon' => '<i data-feather="bar-chart"></i>'
                ],
];
        @endphp
        @foreach($items as $item)
            <li>
                <a href="{{ $item->url }}">
                    {!! $item->icon !!}
                    {{ $item->title }}
                </a>
            </li>
        @endforeach


    </ul>


    <a href="#" class="flex items-center justify-center gap-4 font-bold absolute bottom-8 text-white">
        {{ __('general.logout') }}
        <i data-feather="log-out"></i>
    </a>
</div>

{{--@push('scripts')--}}
{{--    <script>--}}
{{--        document.addEventListener("alpine:init", () => {--}}
{{--            Alpine.data('sidebar', () => ({--}}
{{--                items : [--}}
{{--                    {title : "{{ __('general.dashboard') }}",        url: '#', icon : '<i data-feather="anchor"></i>' },--}}
{{--                    {title : "{{ __('general.languages') }}",        url: '#', icon : '<i data-feather="globe"></i>' },--}}
{{--                    {title : "{{ __('general.searches') }}",         url: '#', icon : '<i data-feather="search"></i>' },--}}
{{--                    {title : "{{ __('general.settings') }}",         url: '#', icon : '<i data-feather="settings"></i>' },--}}
{{--                    {title : "{{ __('general.logout') }}",           url: '#', icon : '<i data-feather="log-out"></i>' },--}}
{{--                    {title : "{{ __('general.profile') }}",          url: '#', icon : '<i data-feather="user"></i>' },--}}
{{--                    {title : "{{ __('general.users') }}",            url: '#', icon : '<i data-feather="users"></i>' },--}}
{{--                    {title : "{{ __('general.comments') }}",         url: '#', icon : '<i data-feather="message-square"></i>' },--}}
{{--                    {title : "{{ __('general.statistics') }}",       url: '#', icon : '<i data-feather="bar-chart"></i>' },--}}
{{--                ],--}}
{{--            }))--}}
{{--        })--}}
{{--    </script>--}}
{{--@endpush--}}
