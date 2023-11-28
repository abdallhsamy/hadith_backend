<x-layouts.mobile.default>
    @push('title', $hadith->translation()->title)
    @push('seo')
        {!! seo()->for($hadith) !!}
    @endpush
    <div class="flex flex-col gap-4 divide-y">
        <div class="flex items-center justify-between gap-4">
            <h1 class="text-xl font-bold truncate">{{ $hadith->translation()->title }}</h1>

            <button class=" rounded-md bg-primary p-1 toggle-bookmark" data-id="{{ $hadith->_id }}">
                @if(in_array($hadith->_id, auth()->user()->bookmarkedHadiths()->pluck('_id')->toArray()))
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <g fill="none">
                                <path opacity=".3" d="M7 17.97l5-2.15 5 2.15V5H7v12.97z" fill="#f7f7f7"></path>
                                <path d="M17 3H7c-1.1 0-2 .9-2 2v16l7-3 7 3V5c0-1.1-.9-2-2-2zm0 14.97l-5-2.14-5 2.14V5h10v12.97z" fill="#f7f7f7"></path>
                            </g>
                        </svg>
                @else
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <g fill="none">
                                <path d="M17 3H7c-1.1 0-2 .9-2 2v16l7-3 7 3V5c0-1.1-.9-2-2-2zm0 15l-5-2.18L7 18V5h10v13z" fill="#f7f7f7"></path>
                            </g>
                        </svg>
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
            </button>

        </div>

        <div class="">
            <div class="flex items center justify-between mb-4">
                <h2 class="text-2xl">{{ __('general.hadith_text') }}</h2>
                <div><i class="mdi mdi-eye"></i> {{ $hadith->views }}</div>

            </div>
            <p class="text-justify">{{ $hadith->translation()->hadeeth }}</p>
        </div>

        <div class="flex items-center justify-between">
            <h2 class="text-2xl">{{ __('general.hadith_grade') }}</h2>
            <p class="rounded-full bg-primary text-white text-xs py-2 ps-2 pe-3 leading-none">{{ $hadith->translation()->grade }}</p>
        </div>

        <div class="flex items-center justify-between">
            <h2 class="text-2xl">{{ __('general.hadith_attribution') }}</h2>
            <p class="rounded-full bg-primary text-white text-xs py-2 ps-2 pe-3 leading-none">{{ $hadith->translation()->attribution }}</p>
        </div>


        <div class="">
            <h2 class="text-2xl">{{ __('general.hadith_explanation') }}</h2>
            <p class="py-2 leading-none text-justify">{{ $hadith->translation()->explanation }}</p>
        </div>


        <div class="">
            <h2 class="text-2xl">{{ __('general.hadith_reference') }}</h2>
            <p class="py-2 leading-none text-justify">{{ $hadith->translation()->reference }}</p>
        </div>

        @if(isset($hadith->translation()->hints) && count($hadith->translation()->hints) > 0)
            <div class="">
                <h2 class="text-2xl mb-4">{{ __('general.hadith_hints') }}</h2>
                <ul class="list-inside list-disc">
                    @foreach($hadith->translation()->hints as $hint)
                        <li>{{ $hint }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        @if(isset($hadith->translation()->words_meanings) && count($hadith->translation()->words_meanings) > 0)
            <div class=" ">
                <h2 class="text-2xl mb-4">{{ __('general.hadith_words_meanings') }}</h2>
                <ul class="list-inside list-disc">

                </ul>

                <table class="w-full border ">
                    <thead>
                    <tr class="bg-shade">
                        <th>{{ __('general.word') }}</th>
                        <th>{{ __('general.meaning') }}</th>
                    </tr>
                    </thead>
                    <tbody class="divide-y">
                    @foreach($hadith->translation()->words_meanings as $wordsMeaning)
                        <tr class="hover:bg-shade">
                            <th class="text-start w-1/3 p-2">{{ $wordsMeaning['word'] }}</th>
                            <td class="text-start  p-2">{{ $wordsMeaning['meaning'] }}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        @endif


        @if(isset($hadith->translations) && count($hadith->translations) > 0)
            <div class="">
                <h2 class="text-2xl mb-4">{{ __('general.available_translations') }}</h2>
                <div class="flex flex-wrap items-center justify-between gap-x-4 gap-y-2">
                    @foreach($hadith->languages as $translation)
                        <a href="{{ route('mobile.hadiths.show', ['hadith' => $hadith->_id, 'lang' => $translation->code]) }}">
                            <div class="rounded-full bg-primary text-white flex-1 whitespace-nowrap text-center text-xs py-1 px-2 leading-none">
                                <span class="align-middle">{{ $translation->native }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif



        {{--            <tr><th class="whitespace-nowrap">{{ __('general.hadith_categories') }}</th><td>{{ $hadith->translation()->categories }}</td></tr>--}}
        <x-mobile.shareon/>

    </div>




</x-layouts.mobile.default>
