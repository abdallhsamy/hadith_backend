<x-layouts.dashboard.default>

    <div class="flex items-center justify-between mb-8">
        <h1 class="text-lg font-medium truncate me-5">{{ __('general.hadith_list') }}</h1>
        <a href="{{ route('dashboard.hadiths.create') }}" class="bg-primary text-white py-2 px-4 rounded-md">
            {{ __('general.add_new_hadith') }}
        </a>
    </div>

    <div class="panel">

        {{--        <div id="wrapper"></div>--}}

        <table class="min-w-full divide-y divide-shade dark:divide-shade table-auto">
            <thead>
            <th scope="col" class="px-6 py-2 text-start text-xs font-medium text-gray-500 uppercase">#</th>
            <th scope="col" class="px-6 py-2 text-start text-xs font-medium text-gray-500 uppercase">{{ __('general.title') }}</th>
            <th scope="col" class="px-6 py-2 text-start text-xs font-medium text-gray-500 uppercase">{{ __('general.hadith_grade') }}</th>
            <th scope="col" class="px-6 py-2 text-start text-xs font-medium text-gray-500 uppercase">{{ __('general.hadith_translations') }}</th>
            <th scope="col" class="px-6 py-2 text-start text-xs font-medium text-gray-500 uppercase">{{ __('general.views') }}</th>
            <th scope="col" class="px-6 py-2 text-end text-xs font-medium text-gray-500 uppercase">{{ __('general.actions') }}</th>
            </thead>
            <tbody>
            @foreach($hadiths as $hadith)
                <tr class="hover:bg-shade">
                    <td class="px-6 py-2 whitespace-nowrap text-sm font-medium">{{ $loop->iteration }}</td>
                    <td class=" px-6 py-2 whitespace-nowrap text-sm font-medium">{{ $hadith->translation()->title }}</td>
                    <td class="px-6 py-2 whitespace-nowrap text-sm font-medium">{{ $hadith->translation()->grade }}</td>
                    <td class="px-6 py-2 whitespace-nowrap text-sm font-medium">{{ $hadith->languages->count() }}</td>
                    <td class="px-6 py-2 whitespace-nowrap text-sm font-medium">{{ $hadith->views }}</td>
                    <td class="px-6 py-2 text-end whitespace-nowrap text-sm font-medium">#</td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {!! $hadiths->links('pagination::tailwind') !!}
        </div>
    </div>

    {{--    @push('scripts')--}}

    {{--        <script >--}}

    {{--            document.addEventListener('DOMContentLoaded', function() {--}}
    {{--                new Grid({--}}
    {{--                    hadith: {--}}
    {{--                        'search': {--}}
    {{--                            'placeholder': '🔍 {{ __('general.search') }}...'--}}
    {{--                        },--}}
    {{--                        'pagination': {--}}
    {{--                            'previous': '⬅️',--}}
    {{--                            'next': '➡️',--}}
    {{--                            'showing': '😃 Displaying',--}}
    {{--                            'to' : 'to',--}}
    {{--                            'of' : 'of',--}}
    {{--                            'results': () => 'Records'--}}
    {{--                        }--}}
    {{--                    },--}}

    {{--                    // search: {--}}
    {{--                    //     server: {--}}
    {{--                    //         url: (prev, keyword) => `${prev}?search=${keyword}`--}}
    {{--                    //     }--}}
    {{--                    // },--}}
    {{--                    search: true,--}}
    {{--                    sort: true,--}}
    {{--                    pagination: {--}}
    {{--                        limit: 10,--}}
    {{--                        summary: true--}}
    {{--                    },--}}
    {{--                    columns: [--}}
    {{--                        "#",--}}
    {{--                        "{{ __('general.title') }}",--}}
    {{--                        "{{ __('general.hadiths_count') }}",--}}
    {{--                        {--}}
    {{--                            name: "{{ __('general.actions') }}",--}}
    {{--                            formatter: (_, row) => gridHtml(`<i class="mdi mdi-eye" data-id="${row.cells[3].data}"></i>`),--}}
    {{--                        }--}}
    {{--                    ],--}}
    {{--                    server: {--}}
    {{--                        headers: { 'Accept-Charset': 'utf-8', 'Content-Type': 'application/json', 'Accept': 'application/json' },--}}
    {{--                        url: "{{ route('dashboard.hadiths.index') }}",--}}
    {{--                        handle: (res) => {--}}
    {{--                            // no matching records found--}}
    {{--                            if (res.status === 404) return {data: []};--}}
    {{--                            if (res.ok) return res.json();--}}

    {{--                            throw Error('oh no :(');--}}
    {{--                        },--}}
    {{--                        then: data => data.data.map(item => [--}}
    {{--                            item.id,--}}
    {{--                            item.title,--}}
    {{--                            item.hadeeths_count,--}}
    {{--                            item._id,--}}
    {{--                        ]),--}}
    {{--                        // total: data => data.total,--}}

    {{--                    }--}}
    {{--                }).render(document.getElementById("wrapper"));--}}
    {{--            })--}}

    {{--        </script>--}}
    {{--    @endpush--}}
</x-layouts.dashboard.default>
