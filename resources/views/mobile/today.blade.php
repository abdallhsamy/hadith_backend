<x-layouts.mobile.default>

    @section('title', __('general.today'))

    <div class="mb-3">
        <h1 class="text-3xl font-bold">{{ __('general.today') }}</h1>
        <p class="text-sm text-gray-500 uppercase font-bold">{{ \Carbon\Carbon::today()->translatedFormat('D d, M') }}</p>
    </div>
    @foreach($today as  $todayItem)
        <div class="mb-5">
            <a href="{{ route('mobile.hadiths.show', $todayItem->_id) }}"
               class="block rounded-lg relative p-5 transform transition-all duration-300 scale-100 hover:scale-95"
               style="background: url({{ asset('assets/images/gradient_placeholder.png') }}) center; background-size: cover;">
                <div class="absolute top-0 right-0 -mt-3 me-3 flex gap-4">

                    @foreach($todayItem->categoriesRel as $cat)
                        <div class="rounded-full bg-primary text-white text-xs py-1 ps-2 pe-3 leading-none">
                            <i class="mdi mdi-fire text-base align-middle"></i>
                            <span class="align-middle">{{ $cat->translation()->title }}</span>
                        </div>

                    @endforeach
                </div>
                <div class="h-48"></div>
                <h2 class="text-white text-2xl font-bold leading-tight mb-3 pe-5">
                    {{ $todayItem->translation()->title }}
                </h2>
                <div class="flex w-full items-center text-sm text-gray-300 font-medium">
                    <div class="flex-1 flex items-center">
                        {{--                        <div class="rounded-full w-8 h-8 me-3" style="background: url(https://randomuser.me/api/portraits/women/74.jpg) center; background-size: cover;"></div>--}}
                        {{--                        <div>Gwen Thomson</div>--}}
                    </div>
                    <div><i class="mdi mdi-eye"></i> {{ $todayItem->views }}</div>
                </div>
            </a>

        </div>
    @endforeach
    <div class="mb-3">
        <h1 class="text-3xl font-bold">{{ __('general.yesterday') }}</h1>
        <p class="text-sm text-gray-500 uppercase font-bold">{{ \Carbon\Carbon::yesterday()->translatedFormat('D d, M') }}</p>
    </div>

    <div class="flex -mx-1 mb-5">
        @php
            $odds = [];
            $evens = [];
        @endphp
        @foreach($yesterday as $yesterdayItem)
            {{--            @dd($loop)--}}
            @if($loop->iteration <= $loop->count /2)
                @php($odds[] = $yesterdayItem)
            @else
                @php($evens[] = $yesterdayItem)
            @endif
        @endforeach
        <div class="w-1/2 px-1">
            @foreach($odds as $item)
                <a href="{{ route('mobile.hadiths.show', $item->_id) }}"
                   class="block mb-2 p-5 rounded overflow-hidden transform transition-all duration-300 scale-100 hover:scale-95"
                   style="background: url({{ asset('assets/images/gradient_placeholder.png') }}) center; background-size: cover;">
                    <div class="{{ $loop->iteration % 2 == 0  ? 'h-32' : 'h-24' }}"></div>
                    <h3 class="text-lg font-bold text-white leading-tight">{{ $item->translation()->title }}</h3>
                </a>
            @endforeach
            {{--            <a href="#" class="block mb-2 p-5 rounded overflow-hidden transform transition-all duration-300 scale-100 hover:scale-95" style="background: url(https://images.unsplash.com/photo-1470225620780-dba8ba36b745?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=800&q=60) center; background-size: cover;">--}}
            {{--                <div class="h-24"></div>--}}
            {{--                <h3 class="text-lg font-bold text-white leading-tight">DJ Dan Spins The Wheels</h3>--}}
            {{--            </a>--}}
            {{--            <a href="#" class="block mb-2 p-5 rounded overflow-hidden transform transition-all duration-300 scale-100 hover:scale-95" style="background: url(https://images.unsplash.com/photo-1534329539061-64caeb388c42?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=800&q=60) center; background-size: cover;">--}}
            {{--                <div class="h-32"></div>--}}
            {{--                <h3 class="text-lg font-bold text-white leading-tight">Top Travels Destinations For 2020</h3>--}}
            {{--            </a>--}}
        </div>
        <div class="w-1/2 px-1">
            @foreach($evens as $item)
                <a href="{{ route('mobile.hadiths.show', $item->_id) }}"
                   class="block mb-2 p-5 rounded overflow-hidden transform transition-all duration-300 scale-100 hover:scale-95"
                   style="background: url({{ asset('assets/images/gradient_placeholder.png') }}) center; background-size: cover;">
                    <div class="{{ $loop->iteration % 2 == 0  ? 'h-24' : 'h-32' }}"></div>
                    <h3 class="text-lg font-bold text-white leading-tight">{{ $item->translation()->title }}</h3>
                </a>
            @endforeach
            {{--            <a href="#" class="block mb-2 p-5 rounded overflow-hidden transform transition-all duration-300 scale-100 hover:scale-95" style="background: url(https://images.unsplash.com/photo-1526661934280-676cef25bc9b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=800&q=60) center; background-size: cover;">--}}
            {{--                <div class="h-32"></div>--}}
            {{--                <h3 class="text-lg font-bold text-white leading-tight">M&S Launches New Makeup Range!</h3>--}}
            {{--            </a>--}}
            {{--            <a href="#" class="block mb-2 p-5 rounded overflow-hidden transform transition-all duration-300 scale-100 hover:scale-95" style="background: url(https://images.unsplash.com/photo-1558365849-6ebd8b0454b2?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=800&q=60) center; background-size: cover;">--}}
            {{--                <div class="h-24"></div>--}}
            {{--                <h3 class="text-lg font-bold text-white leading-tight">APT Set To Be A&nbsp;Ripper</h3>--}}
            {{--            </a>--}}
        </div>
    </div>
    <div class="mb-3">
        <h1 class="text-3xl font-bold">{{ __('general.previous') }}</h1>
    </div>
    @foreach($old as $item)
        <div>
            <a href="{{ route('mobile.hadiths.show', $item->_id) }}" class="flex w-full transform transition-all duration-300 scale-100 hover:scale-95">
                <div class="block h-24 w-2/5 rounded overflow-hidden"
                     style="background: url({{ asset('assets/images/gradient_placeholder.png') }}) center; background-size: cover;"></div>
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
</x-layouts.mobile.default>
