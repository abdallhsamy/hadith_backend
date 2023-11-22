<x-layouts.mobile.default>

    <div class="mb-3 flex items-center justify-between pb-2 border-b">
        <h1 class="text-xl font-bold truncate">{{ $hadith->translation()->title }}</h1>
        {{--        <p class="text-sm text-gray-500 uppercase font-bold">{{ \Carbon\Carbon::today()->translatedFormat('D d, M') }}</p>--}}

        {{--        <div class="display-icons flex items-center justify-between gap-1 border px-2 rounded-md">--}}
        {{--            <svg class="display-icon" data-type="grid_container" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><title>{{ __('general.grid_display') }}</title><g fill="#006837"><rect x="1" y="1" width="9" height="9" rx="1" ry="1" fill="#006837"></rect> <rect x="14" y="1" width="9" height="9" rx="1" ry="1"></rect> <rect x="1" y="14" width="9" height="9" rx="1" ry="1"></rect> <rect x="14" y="14" width="9" height="9" rx="1" ry="1" fill="#006837"></rect></g></svg>--}}
        {{--            <svg class="display-icon -me-1" data-type="list_container" xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24"><title>{{ __('general.list_display') }}</title><g fill="none"><path d="M4 14h4v-4H4v4zm0 5h4v-4H4v4zM4 9h4V5H4v4zm5 5h12v-4H9v4zm0 5h12v-4H9v4zM9 5v4h12V5H9z" fill="#6B7280"></path></g></svg>--}}
        {{--        </div>--}}


    </div>

    {{--    <div class="flex gap-4">--}}
    {{--        @foreach($hadith->categoriesRel as $cat)--}}
    {{--            <div class="rounded-full bg-primary text-white text-xs py-1 ps-2 pe-3 leading-none">--}}
    {{--                <i class="mdi mdi-fire text-base align-middle"></i>--}}
    {{--                <span class="align-middle">{{ $cat->translation()->title }}</span>--}}
    {{--            </div>--}}

    {{--        @endforeach--}}
    {{--    </div>--}}


    {{--    <div class="flex items-center justify-between py-2 border-b">--}}
    {{--        <h2 class="text-2xl">{{ __('general.hadith_category') }}</h2>--}}
    {{--        <div class="flex gap-4">--}}
    {{--            @foreach($hadith->categoriesRel as $cat)--}}
    {{--                <div class="rounded-full bg-primary text-white text-xs py-1 ps-2 pe-3 leading-none">--}}
    {{--                    <i class="mdi mdi-fire text-base align-middle"></i>--}}
    {{--                    <span class="align-middle">{{ $cat->translation()->title }}</span>--}}
    {{--                </div>--}}

    {{--            @endforeach--}}
    {{--        </div>--}}
    {{--    </div>--}}
    {{--    <div class="flex items-center justify-between py-2 border-b">--}}
    {{--        <h2 class="text-2xl">{{ __('general.hadith_grade') }}</h2>--}}
    {{--        <p class="rounded-full bg-primary text-white text-xs py-2 ps-2 pe-3 leading-none">{{ $hadith->translation()->grade }}</p>--}}
    {{--    </div>--}}



    <div class="border-b">
        <div class="flex items center justify-between mb-4">
            <h2 class="text-2xl">{{ __('general.hadith_text') }}</h2>
            <div><i class="mdi mdi-eye"></i> {{ $hadith->views }}</div>

        </div>
        <p class="text-justify">{{ $hadith->translation()->hadeeth }}</p>
    </div>

    <div class="flex items-center justify-between py-2 border-b">
        <h2 class="text-2xl">{{ __('general.hadith_grade') }}</h2>
        <p class="rounded-full bg-primary text-white text-xs py-2 ps-2 pe-3 leading-none">{{ $hadith->translation()->grade }}</p>
    </div>

    <div class="flex items-center justify-between py-2 border-b">
        <h2 class="text-2xl">{{ __('general.hadith_attribution') }}</h2>
        <p class="rounded-full bg-primary text-white text-xs py-2 ps-2 pe-3 leading-none">{{ $hadith->translation()->attribution }}</p>
    </div>


    <div class="py-2 border-b">
        <h2 class="text-2xl">{{ __('general.hadith_explanation') }}</h2>
        <p class="py-2 leading-none text-justify">{{ $hadith->translation()->explanation }}</p>
    </div>


    <div class="py-2 border-b">
        <h2 class="text-2xl">{{ __('general.hadith_reference') }}</h2>
        <p class="py-2 leading-none text-justify">{{ $hadith->translation()->reference }}</p>
    </div>

    {{--    title--}}

    {{--    attribution--}}
    {{--    grade--}}
    {{--    explanation--}}
    {{--    hints--}}
    {{--    categories--}}
    {{--    translations--}}
    {{--    words_meanings--}}
    {{--    reference--}}
    {{--    views--}}
    @if(isset($hadith->translation()->hints) && count($hadith->translation()->hints) > 0)
        <div class="py-2 border-b">
            <h2 class="text-2xl mb-4">{{ __('general.hadith_hints') }}</h2>
            <ul class="list-inside list-disc">
                @foreach($hadith->translation()->hints as $hint)
                    <li>{{ $hint }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    @if(isset($hadith->translation()->words_meanings) && count($hadith->translation()->words_meanings) > 0)
        <div class="py-2 border-b">
            <h2 class="text-2xl mb-4">{{ __('general.hadith_words_meanings') }}</h2>
            <ul class="list-inside list-disc">

            </ul>

            <table class="">
                <tbody class="divide-y">
                @foreach($hadith->translation()->words_meanings as $wordsMeaning)
                    <tr><th class="text-start">{{ $wordsMeaning['word'] }}</th><td class="text-start">{{ $wordsMeaning['meaning'] }}</td></tr>
                @endforeach

                </tbody>
            </table>
        </div>
    @endif


    @if(isset($hadith->translations) && count($hadith->translations) > 0)
        <div class=" py-2 border-b">
            <h2 class="text-2xl mb-4">{{ __('general.available_translations') }}</h2>
            <div class="flex flex-wrap items-center justify-between gap-x-4 gap-y-2">
                @foreach($hadith->languages as $translation)
                    <div class="rounded-full bg-primary text-white flex-1 whitespace-nowrap text-center text-xs py-1 px-2 leading-none">
                        <span class="align-middle">{{ $translation->native }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    @endif



    {{--            <tr><th class="whitespace-nowrap">{{ __('general.hadith_categories') }}</th><td>{{ $hadith->translation()->categories }}</td></tr>--}}

</x-layouts.mobile.default>
