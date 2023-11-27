{{--@props([--}}
{{--    'hadithId',--}}
{{--    'isBookmarked' => false,--}}
{{--])--}}

{{--<div x-data="bookmark">--}}
{{--    <element x-if="isBookmarked">--}}
{{--        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">--}}
{{--            <g fill="none">--}}
{{--                <path opacity=".3" d="M7 17.97l5-2.15 5 2.15V5H7v12.97z" fill="#f7f7f7"></path>--}}
{{--                <path d="M17 3H7c-1.1 0-2 .9-2 2v16l7-3 7 3V5c0-1.1-.9-2-2-2zm0 14.97l-5-2.14-5 2.14V5h10v12.97z" fill="#f7f7f7"></path>--}}
{{--            </g>--}}
{{--        </svg>--}}
{{--    </element>--}}
{{--    <element x-else>--}}
{{--        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">--}}
{{--            <g fill="none">--}}
{{--                <path d="M17 3H7c-1.1 0-2 .9-2 2v16l7-3 7 3V5c0-1.1-.9-2-2-2zm0 15l-5-2.18L7 18V5h10v13z" fill="#f7f7f7"></path>--}}
{{--            </g>--}}
{{--        </svg>--}}
{{--    </element>--}}
{{--    @if($isBookmarked)--}}

{{--        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">--}}
{{--            <g fill="none">--}}
{{--                <path opacity=".3" d="M7 17.97l5-2.15 5 2.15V5H7v12.97z" fill="#f7f7f7"></path>--}}
{{--                <path d="M17 3H7c-1.1 0-2 .9-2 2v16l7-3 7 3V5c0-1.1-.9-2-2-2zm0 14.97l-5-2.14-5 2.14V5h10v12.97z" fill="#f7f7f7"></path>--}}
{{--            </g>--}}
{{--        </svg>--}}

{{--    @else--}}

{{--        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">--}}
{{--            <g fill="none">--}}
{{--                <path d="M17 3H7c-1.1 0-2 .9-2 2v16l7-3 7 3V5c0-1.1-.9-2-2-2zm0 15l-5-2.18L7 18V5h10v13z" fill="#f7f7f7"></path>--}}
{{--            </g>--}}
{{--        </svg>--}}
{{--    @endif--}}
{{--</div>--}}

{{--@push('scripts')--}}
{{--    <script>--}}
{{--        document.addEventListener("alpine:init", () => {--}}

{{--            Alpine.data("bookmark_{{ $hadithId }}", () => ({--}}
{{--                isBookmarked: {{ $isBookmarked }},--}}

{{--                toggleBookmark() {--}}
{{--                    axios.get(`{{ route('mobile.hadiths.bookmark', ':hadithId') }}`.replace(':hadithId', hadithId))--}}
{{--                        .then(response => {--}}
{{--                            if (response.status == 200) {--}}
{{--                                console.log('yes it is 200');--}}
{{--                                console.log(response.data.bookmarked)--}}
{{--                                // this.isBookmarked = ! this.isBookmarked;--}}
{{--                                this.isBookmarked = response.data.bookmarked;--}}
{{--                            } else {--}}
{{--                                console.log('something went wrong');--}}
{{--                            }--}}
{{--                        })--}}
{{--                },--}}
{{--            }));--}}


{{--        });--}}
{{--    </script>--}}

{{--@endpush--}}
