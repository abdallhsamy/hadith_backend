<x-layouts.mobile.default>

    <div class="mb-3 flex items-center justify-between pb-2 border-b">
        <h1 class="text-3xl font-bold">{{ __('general.search') }}</h1>
        {{--        <p class="text-sm text-gray-500 uppercase font-bold">{{ \Carbon\Carbon::today()->translatedFormat('D d, M') }}</p>--}}

    </div>

    <form action="">

        <div class="flex flex-col items-center justify-between gap-4">
            <input id="search" name="search" type="text" class="bg-shade h-12 px-2 border border-gray-300 text-gray-90 rounded-md w-full" placeholder="{{ __('general.search') }}... 🔍">
            <select class="bg-shade h-12 px-2 border border-gray-300 text-gray-900 rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full">
                <option selected>{{ __('general.select_language') }}</option>
                @foreach($languages as $language)
                    <option value="{{  $language->code }}">{{ $language->native }}</option>
                @endforeach
            </select>

{{--            <select class="bg-shade h-12 px-2 border border-gray-300 text-gray-900 rounded-md focus:ring-blue-500 focus:border-blue-500 block w-full">--}}
{{--                <option selected>{{ __('general.search_in') }}</option>--}}
{{--                @foreach($languages as $language)--}}
{{--                    <option value="{{  $language->code }}">{{ $language->native }}</option>--}}
{{--                @endforeach--}}
{{--            </select>--}}

            <button class="text-white bg-primary h-12 px-2 rounded-md w-full" type="submit">{{ __('general.search') }}</button>
        </div>
    </form>

</x-layouts.mobile.default>
