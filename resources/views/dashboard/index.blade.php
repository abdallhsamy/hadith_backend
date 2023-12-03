<x-layouts.dashboard.default>

{{--    <div class="flex items-center justify-between">--}}
{{--        <h1 class="text-lg font-medium truncate me-5">{{ __('general.hadith_list') }}</h1>--}}
{{--    </div>--}}

    <div class="flex flex-wrap gap-4">
        <div class="flex flex-col gap-4 bg-white px-6 py-4 flex-1 border rounded-lg">
            <h4>Users</h4>
            <h2 class="text-xl font-bold">{{ $userCount }}</h2>
        </div>
        <div class="flex flex-col gap-4 bg-white px-6 py-4 flex-1 border rounded-lg">
            <h4>Comments</h4>
            <h2 class="text-xl font-bold">{{ $commentCount }}</h2>
        </div>

        <div class="flex flex-col gap-4 bg-white px-6 py-4 flex-1 border rounded-lg">
            <h4>Hadiths</h4>
            <h2 class="text-xl font-bold">{{ $hadithCount }}</h2>
        </div>
        <div class="flex flex-col gap-4 bg-white px-6 py-4 flex-1 border rounded-lg">
            <h4>Categories</h4>
            <h2 class="text-xl font-bold">{{ $categoryCount }}</h2>
        </div>
        <div class="flex flex-col gap-4 bg-white px-6 py-4 flex-1 border rounded-lg">
            <h4>Languages</h4>
            <h2 class="text-xl font-bold">{{ $languageCount }}</h2>
        </div>

    </div>
</x-layouts.dashboard.default>
