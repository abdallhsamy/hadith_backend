<x-layouts.dashboard.default>

    <div class="flex items-center justify-between mb-8">
        <h1 class="text-lg font-medium truncate me-5">{{ __('general.category_list') }}</h1>
        <a href="{{ route('dashboard.categories.create') }}" class="bg-primary text-white py-2 px-4 rounded-md">
            {{ __('general.add_new_category') }}
        </a>
    </div>

    <div class="panel">
        <table class="min-w-full divide-y divide-shade dark:divide-shade">
            <thead>
            <th scope="col" class="px-6 py-2 text-start text-xs font-medium text-gray-500 uppercase">#</th>
            <th scope="col" class="px-6 py-2 text-start text-xs font-medium text-gray-500 uppercase">{{ __('general.title') }}</th>
            <th scope="col" class="px-6 py-2 text-start text-xs font-medium text-gray-500 uppercase">{{ __('general.hadiths_count') }}</th>
            <th scope="col" class="px-6 py-2 text-end text-xs font-medium text-gray-500 uppercase">{{ __('general.actions') }}</th>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr class="hover:bg-shade">
                    <td class="px-6 py-2 whitespace-nowrap text-sm font-medium ">{{ $category->id }}</td>
                    <td class="px-6 py-2 whitespace-nowrap text-sm font-medium ">{{ $category->translation()->title }}</td>
                    <td class="px-6 py-2 whitespace-nowrap text-sm font-medium ">{{ $category->hadeeths_count }}</td>
                    <td class="px-6 py-2 whitespace-nowrap text-sm font-medium ">#</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {!! $categories->links() !!}

        </div>
    </div>

</x-layouts.dashboard.default>
