<x-layouts.mobile.default>
    @section('title', $category->translation()->title . ' | ' . __('general.hadith_list'))

    <div class="mb-3 flex items-center justify-between pb-2 border-b">
        <h1 class="text-3xl font-bold">{{ $category->translation()->title }}</h1>

        <div class=" flex items-center justify-between gap-4">

            <select id="change_language" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                <option selected>{{ __('general.change_language') }}</option>
                @foreach($category->languages as $language)
                    <option value="{{ route('mobile.category.hadiths', ['category' => $category->_id, 'lang' => $language->code]) }}">{{ $language->native }}</option>
                @endforeach
            </select>

            <div class="display-icons flex items-center justify-between gap-1 border px-2 rounded-md">
                <svg class="display-icon" data-type="grid_container" xmlns="http://www.w3.org/2000/svg" width="24"
                     height="24" viewBox="0 0 24 24"><title>{{ __('general.grid_display') }}</title>
                    <g fill="#006837">
                        <rect x="1" y="1" width="9" height="9" rx="1" ry="1" fill="#006837"></rect>
                        <rect x="14" y="1" width="9" height="9" rx="1" ry="1"></rect>
                        <rect x="1" y="14" width="9" height="9" rx="1" ry="1"></rect>
                        <rect x="14" y="14" width="9" height="9" rx="1" ry="1" fill="#006837"></rect>
                    </g>
                </svg>
                <svg class="display-icon -me-1" data-type="list_container" xmlns="http://www.w3.org/2000/svg" width="36"
                     height="36" viewBox="0 0 24 24"><title>{{ __('general.list_display') }}</title>
                    <g fill="none">
                        <path d="M4 14h4v-4H4v4zm0 5h4v-4H4v4zM4 9h4V5H4v4zm5 5h12v-4H9v4zm0 5h12v-4H9v4zM9 5v4h12V5H9z"
                              fill="#6B7280"></path>
                    </g>
                </svg>
            </div>

        </div>
    </div>

    <div id="grid_container">
        @foreach($hadiths as  $item)
            <div class="mb-5">
                <a href="{{ route('mobile.hadiths.show', $item->_id) }}"
                   class="block rounded-lg relative p-5 transform transition-all duration-300 scale-100 hover:scale-95"
                   style="background: url({{ asset('gradient_placeholder.png') }}) center; background-size: cover;">
                    <div class="absolute top-0 ltr:left-0 rtl:right-0 m-4" @click="toggleBookmark(event, `{{ $item->_id }}`)" >
                        @if($item->is_bookmarked)
                            <div class="rounded-md bg-white p-1 bg-opacity-25">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <g fill="none">
                                        <path opacity=".3" d="M7 17.97l5-2.15 5 2.15V5H7v12.97z" fill="#f7f7f7"></path>
                                        <path d="M17 3H7c-1.1 0-2 .9-2 2v16l7-3 7 3V5c0-1.1-.9-2-2-2zm0 14.97l-5-2.14-5 2.14V5h10v12.97z" fill="#f7f7f7"></path>
                                    </g>
                                </svg>
                            </div>
                        @else
                            <div class="rounded-md bg-white p-1 bg-opacity-25">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <g fill="none">
                                        <path d="M17 3H7c-1.1 0-2 .9-2 2v16l7-3 7 3V5c0-1.1-.9-2-2-2zm0 15l-5-2.18L7 18V5h10v13z" fill="#f7f7f7"></path>
                                    </g>
                                </svg>
                            </div>
                        @endif
                        {{--                            @if($isBookmarked)--}}

                        {{--                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">--}}
                        {{--                                    <g fill="none">--}}
                        {{--                                        <path opacity=".3" d="M7 17.97l5-2.15 5 2.15V5H7v12.97z" fill="#f7f7f7"></path>--}}
                        {{--                                        <path d="M17 3H7c-1.1 0-2 .9-2 2v16l7-3 7 3V5c0-1.1-.9-2-2-2zm0 14.97l-5-2.14-5 2.14V5h10v12.97z" fill="#f7f7f7"></path>--}}
                        {{--                                    </g>--}}
                        {{--                                </svg>--}}
                        {{--                            @else--}}
                        {{--                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">--}}
                        {{--                                    <g fill="none">--}}
                        {{--                                        <path d="M17 3H7c-1.1 0-2 .9-2 2v16l7-3 7 3V5c0-1.1-.9-2-2-2zm0 15l-5-2.18L7 18V5h10v13z" fill="#f7f7f7"></path>--}}
                        {{--                                    </g>--}}
                        {{--                                </svg>--}}
                        {{--                            @endif--}}
                    </div>

                    <div class="absolute top-0 ltr:right-0 rtl:left-0 -mt-3 me-3 flex flex-wrap gap-4">

                        @foreach($item->categoriesRel as $cat)
                            <div class="rounded-full bg-primary whitespace-nowrap text-white text-xs py-1 ps-2 pe-3 leading-none">
                                <i class="mdi mdi-fire text-base align-middle"></i>
                                <span class="align-middle">{{ $cat->translation()->title }}</span>
                            </div>

                        @endforeach
                    </div>
                    <div class="h-48"></div>
                    <h2 class="text-white text-2xl font-bold leading-tight mb-3 pe-5">
                        {{ $item->translation()->title }}
                    </h2>
                    <div class="flex w-full items-center text-sm text-gray-300 font-medium">
                        <div class="flex-1 flex items-center">
                            {{--                        <div class="rounded-full w-8 h-8 me-3" style="background: url(https://randomuser.me/api/portraits/women/74.jpg) center; background-size: cover;"></div>--}}
                            {{--                        <div>Gwen Thomson</div>--}}
                        </div>
                        <div><i class="mdi mdi-eye"></i> {{ $item->views }}</div>
                    </div>
                </a>

            </div>
        @endforeach
    </div>

    <div id="list_container" class="hidden">
        @foreach($hadiths as $item)
            <div>
                <a href="{{ route('mobile.hadiths.show', $item->_id) }}"
                   class="flex w-full transform transition-all duration-300 scale-100 hover:scale-95">
                    <div class="block h-24 w-2/5 rounded overflow-hidden"
                         style="background: url({{ asset('gradient_placeholder.png') }}) center; background-size: cover;"></div>
                    <div class="absolute top-0 ltr:left-0 rtl:right-0 m-4" @click="toggleBookmark(event, `{{ $item->_id }}`)" >
                        @if(auth()->check() && in_array($hadith->_id, auth()->user()->bookmarkedHadiths()->pluck('_id')->toArray()))
                            <div class="rounded-md bg-white p-1 bg-opacity-25">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <g fill="none">
                                        <path opacity=".3" d="M7 17.97l5-2.15 5 2.15V5H7v12.97z" fill="#f7f7f7"></path>
                                        <path d="M17 3H7c-1.1 0-2 .9-2 2v16l7-3 7 3V5c0-1.1-.9-2-2-2zm0 14.97l-5-2.14-5 2.14V5h10v12.97z" fill="#f7f7f7"></path>
                                    </g>
                                </svg>
                            </div>
                        @else
                            <div class="rounded-md bg-white p-1 bg-opacity-25">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                    <g fill="none">
                                        <path d="M17 3H7c-1.1 0-2 .9-2 2v16l7-3 7 3V5c0-1.1-.9-2-2-2zm0 15l-5-2.18L7 18V5h10v13z" fill="#f7f7f7"></path>
                                    </g>
                                </svg>
                            </div>
                        @endif
                        {{--                            @if($isBookmarked)--}}

                        {{--                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">--}}
                        {{--                                    <g fill="none">--}}
                        {{--                                        <path opacity=".3" d="M7 17.97l5-2.15 5 2.15V5H7v12.97z" fill="#f7f7f7"></path>--}}
                        {{--                                        <path d="M17 3H7c-1.1 0-2 .9-2 2v16l7-3 7 3V5c0-1.1-.9-2-2-2zm0 14.97l-5-2.14-5 2.14V5h10v12.97z" fill="#f7f7f7"></path>--}}
                        {{--                                    </g>--}}
                        {{--                                </svg>--}}
                        {{--                            @else--}}
                        {{--                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">--}}
                        {{--                                    <g fill="none">--}}
                        {{--                                        <path d="M17 3H7c-1.1 0-2 .9-2 2v16l7-3 7 3V5c0-1.1-.9-2-2-2zm0 15l-5-2.18L7 18V5h10v13z" fill="#f7f7f7"></path>--}}
                        {{--                                    </g>--}}
                        {{--                                </svg>--}}
                        {{--                            @endif--}}
                    </div>

                    <div class="ps-3 w-3/5">
                        <div
                            class="text-xs text-gray-500 uppercase font-semibold flex gap-1 @if($item->categoriesRel->count() > 0) mb-2 @endif">
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

    <div class="flex items-center justify-between py-4">
        {!! $hadiths->links() !!}
    </div>

    <x-mobile.shareon/>

    @push('scripts')
        <script>
            const toggleDisplayContainers = (type) => {
                ['grid_container', 'list_container'].forEach(function (containerId) {
                    const container = document.getElementById(containerId);
                    if (containerId === type) {
                        container.classList.remove('hidden');
                        localStorage.setItem('__CONFIG_ALL_DISPLAY_TYPE__', containerId);
                    } else {
                        container.classList.add('hidden');
                    }
                });
            };

            const updateDisplayIcons = (selectedIcon) => {
                document.querySelectorAll('.display-icon').forEach(function (icon) {
                    ['g', 'path', 'rect'].forEach(function (shape) {
                        if (icon === selectedIcon) {
                            icon.querySelectorAll(shape).forEach(function (g) {
                                g.setAttribute('fill', '#006837');
                            })
                        } else {
                            icon.querySelectorAll(shape).forEach(function (g) {
                                g.setAttribute('fill', '#6B7280');
                            })
                        }
                    })

                });
            };

            addEventListener('DOMContentLoaded', () => {
                const type = localStorage.getItem('__CONFIG_ALL_DISPLAY_TYPE__') ?? 'grid_container';
                toggleDisplayContainers(type);
                updateDisplayIcons(document.querySelector(`[data-type="${type}"]`));
            });

            document.querySelectorAll('.display-icon').forEach(function (icon) {
                icon.addEventListener('click', function () {
                    const type = icon.getAttribute('data-type');
                    toggleDisplayContainers(type);
                    updateDisplayIcons(icon);
                });
            });

        </script>
    @endpush

    @push('scripts')
        <script>
            document.querySelector('#change_language').addEventListener('change', function() {
                window.open(this.value,"_self")
            })
        </script>
    @endpush

</x-layouts.mobile.default>
