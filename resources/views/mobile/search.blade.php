<x-layouts.mobile.default>
    @section('title', __('general.search'))

    <div class="mb-3 flex items-center justify-between pb-2 border-b">
        <h1 class="text-3xl font-bold">{{ __('general.search') }}</h1>
        {{--        <p class="text-sm text-gray-500 uppercase font-bold">{{ \Carbon\Carbon::today()->translatedFormat('D d, M') }}</p>--}}

    </div>

    <form action="{{ route('mobile.postSearch') }}" method="post" class="my-4">
        @csrf

        <div class="flex flex-col items-center justify-between gap-4">
            <input id="query" name="query" value="{{ $query }}" type="text" class=" bg-shade h-12 px-2 border border-gray-300 @error('query') border-red-300 @enderror text-gray-90 rounded-md w-full" placeholder="{{ __('general.search') }}... 🔍">

            @error('query')
            <small id="queryHelp" class="form-text -mt-3 text-sm text-red-700 dark:text-red-400">{{ $message }}</small>
            @enderror

            <select name="language" id="language" class="bg-shade h-12 px-2 border border-gray-300 @error('query') border-red-300 @enderror text-gray-900 rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full">
                <option selected disabled>{{ __('general.select_language') }}</option>
                @foreach($languages as $lang)
                    <option value="{{  $lang->code }}" @selected($language === $lang->code)>{{ $lang->native }}</option>
                @endforeach
            </select>

            @error('language')
            <small id="languageHelp" class="form-text -mt-3 text-sm text-red-700 dark:text-red-400">{{ $message }}</small>
            @enderror

            <button class="text-white bg-primary mt-4 h-12 px-2 rounded-md w-full" type="submit">{{ __('general.search') }}</button>
        </div>
    </form>




    @if(isset($results))
        <div id="search_results_div" class="mb-3 flex flex-col items-center justify-between border-t ">
            <h1 class="text-3xl mt-4 font-bold">{{ __('general.search_results') }}</h1>
            {{--        <p class="text-sm text-gray-500 uppercase font-bold">{{ \Carbon\Carbon::today()->translatedFormat('D d, M') }}</p>--}}

            @if(count($results) > 0)
                <div id="search_results" class="flex flex-col items-center justify-between gap-4">
                    <ul class="list-disc list-inside divide-y">
                        @foreach($results as $item)
                            <li class="my-4 py-4 text-justify">
                                <a href="{{ route('mobile.hadiths.show', $item->_id) }}" class="search-result-item">{{ $item->translation()->hadeeth }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

            @else
                <p class="mt-4">
                    {{ __('general.no_search_results_for_this_query') }}
                </p>
            @endif

        </div>



    @endif

    @push('scripts')
        <script>
            const search_result_items = document.querySelectorAll('.search-result-item')
            if(search_result_items) {
                search_result_items.forEach(function(item) {
                    item.innerHTML = item.innerHTML.replaceAll("{{ $query }}", "<mark>{{ $query }}</mark>")
                })
            }
        </script>
    @endpush

</x-layouts.mobile.default>
