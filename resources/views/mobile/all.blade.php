<x-layouts.mobile.default>

    <div class="mb-3 flex items-center justify-between">
        <h1 class="text-3xl font-bold">{{ __('general.all') }}</h1>
{{--        <p class="text-sm text-gray-500 uppercase font-bold">{{ \Carbon\Carbon::today()->translatedFormat('D d, M') }}</p>--}}

        <div class="display-icons flex items-center justify-between gap-2">
{{--            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 64 64"><title>grid-interface</title><g fill="#006837"><rect x="4" y="4" width="24" height="24" rx="2" fill="#006837"></rect><rect x="36" y="4" width="24" height="24" rx="2"></rect><rect x="4" y="36" width="24" height="24" rx="2"></rect><rect x="36" y="36" width="24" height="24" rx="2" fill="#006837"></rect></g></svg>--}}
            <svg class="display-icon" data-type="grid_container" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><title>grid-interface</title><g fill="#006837"><rect x="1" y="1" width="9" height="9" rx="1" ry="1" fill="#006837"></rect> <rect x="14" y="1" width="9" height="9" rx="1" ry="1"></rect> <rect x="1" y="14" width="9" height="9" rx="1" ry="1"></rect> <rect x="14" y="14" width="9" height="9" rx="1" ry="1" fill="#006837"></rect></g></svg>
{{--            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><title>grid-interface</title><g stroke-width="2" fill="#006837" stroke="#006837"><rect x="2" y="2" width="7" height="7" fill="none" stroke="#006837" stroke-linecap="square" stroke-miterlimit="10"></rect> <rect x="15" y="2" width="7" height="7" fill="none" stroke-linecap="square" stroke-miterlimit="10"></rect> <rect x="2" y="15" width="7" height="7" fill="none" stroke-linecap="square" stroke-miterlimit="10"></rect> <rect x="15" y="15" width="7" height="7" fill="none" stroke="#006837" stroke-linecap="square" stroke-miterlimit="10"></rect></g></svg>--}}
            <svg class="display-icon" data-type="list_container" xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24"><title>view_list</title><g fill="none"><path d="M4 14h4v-4H4v4zm0 5h4v-4H4v4zM4 9h4V5H4v4zm5 5h12v-4H9v4zm0 5h12v-4H9v4zM9 5v4h12V5H9z" fill="#006837"></path></g></svg>
{{--            <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24"><title>format_list_bulleted</title><g fill="none"><path d="M4 10.5c-.83 0-1.5.67-1.5 1.5s.67 1.5 1.5 1.5 1.5-.67 1.5-1.5-.67-1.5-1.5-1.5zm0-6c-.83 0-1.5.67-1.5 1.5S3.17 7.5 4 7.5 5.5 6.83 5.5 6 4.83 4.5 4 4.5zm0 12c-.83 0-1.5.68-1.5 1.5s.68 1.5 1.5 1.5 1.5-.68 1.5-1.5-.67-1.5-1.5-1.5zM7 19h14v-2H7v2zm0-6h14v-2H7v2zm0-8v2h14V5H7z" fill="#006837"></path></g></svg>--}}

        </div>
    </div>

    <div id="grid_container">
        @foreach($hadiths as  $item)
            <div class="mb-5">
                <a href="#" class="block rounded-lg relative p-5 transform transition-all duration-300 scale-100 hover:scale-95" style="background: url({{ asset('gradient_placeholder.png') }}) center; background-size: cover;">
                    <div class="absolute top-0 right-0 -mt-3 me-3 flex gap-4">

                        @foreach($item->categoriesRel as $cat)
                            <div class="rounded-full bg-primary text-white text-xs py-1 pl-2 pr-3 leading-none">
                                <i class="mdi mdi-fire text-base align-middle"></i>
                                <span class="align-middle">{{ $cat->translation()->title }}</span>
                            </div>

                        @endforeach
                    </div>
                    <div class="h-48"></div>
                    <h2 class="text-white text-2xl font-bold leading-tight mb-3 pr-5">
                        {{ $item->translation()->title }}
                    </h2>
                    <div class="flex w-full items-center text-sm text-gray-300 font-medium">
                        <div class="flex-1 flex items-center">
                            {{--                        <div class="rounded-full w-8 h-8 mr-3" style="background: url(https://randomuser.me/api/portraits/women/74.jpg) center; background-size: cover;"></div>--}}
                            {{--                        <div>Gwen Thomson</div>--}}
                        </div>
                        <div><i class="mdi mdi-eye"></i> 18</div>
                    </div>
                </a>

            </div>
        @endforeach
    </div>

    <div id="list_container" class="hidden">
        @foreach($hadiths as $item)
            <div>
                <a href="#" class="flex w-full transform transition-all duration-300 scale-100 hover:scale-95">
                    <div class="block h-24 w-2/5 rounded overflow-hidden" style="background: url({{ asset('gradient_placeholder.png') }}) center; background-size: cover;"></div>
                    <div class="ps-3 w-3/5">
                        <div class="text-xs text-gray-500 uppercase font-semibold flex gap-1 @if($item->categoriesRel->count() > 0) mb-2 @endif">
                            @foreach($item->categoriesRel as $cat)
                                <span class="bg-gray-200 px-2 rounded-lg">
                                {{ $cat->translation()->title }}
                            </span>
                            @endforeach
                        </div>
                        <h3 class="text-md font-semibold leading-tight mb-3">{{ $item->translation()->title }}</h3>
                        {{--                    <div class="flex w-full items-center text-xs text-gray-500 font-medium">--}}
                        {{--                        <div class="rounded-full w-5 h-5 me-3" style="background: url(https://randomuser.me/api/portraits/men/41.jpg) center; background-size: cover;"></div>--}}
                        {{--                        <div>Jack Ryan</div>--}}
                        {{--                    </div>--}}
                    </div>
                </a>
            </div>
            @if(! $loop->last)
                <hr class="border-gray-200 my-3">

            @endif
        @endforeach
    </div>

    @section('scripts')
        <script>
            const toggleDisplayContainers = (type) =>{
                ['grid_container', 'list_container'].forEach(function (containerId) {
                    const container = document.getElementById(containerId);
                    if (containerId === type) {
                        container.classList.remove('hidden');
                        localStorage.setItem('__CONFIG_ALL_DISPLAY_TYPE__', containerId)
                    } else {
                        container.classList.add('hidden');
                    }
                })
            }

            addEventListener('DOMContentLoaded',() => {
                const type = localStorage.getItem('__CONFIG_ALL_DISPLAY_TYPE__') ?? 'grid_container'
                toggleDisplayContainers(type)
            })

            document.querySelectorAll('.display-icon').forEach(function (icon) {
                icon.addEventListener('click', function() {
                    toggleDisplayContainers(icon.getAttribute('data-type'))
                })
            })
        </script>
    @endsection

</x-layouts.mobile.default>
