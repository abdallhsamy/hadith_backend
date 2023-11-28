@props([
    'hadithId',
    'comments' => [],
    'class' => ''
])

@if(count($comments) > 0)
    <div {{ $attributes->merge(['class' => 'flex flex-col items-center justify-between gap-8 ' . $class ]) }}>
        @foreach($comments as $comment)

            <div class="relative bg-shade rounded-md w-full">
                <div class="absolute top-0 ltr:left-0 rtl:right-0 -mt-4 ms-4 border border-shade rounded-xl">
                    <div class="flex items-center justify-between gap-2 bg-shade border border-white rounded-xl p-1">

                        @if($comment->hide_author)
                                <img
                                    src="{{ asset('assets/images/default-avatar.svg') }}"
                                    alt="{{ __('general.user') }}"
                                    class="w-6 h-6 rounded-full"
                                >
                                <span class="font-semibold">{{ __('general.user') }}</span>
                            @else
                            <img
                                src="{{ $comment->author->avatar }}"
                                alt="{{ $comment->author->name }}"
                                class="w-6 h-6 rounded-full"
                            >
                            <span class="font-semibold">{{ $comment->author->name }}</span>
                        @endif

                        <span class="text-xs pe-2">{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                </div>

                <p class="text-justify p-4">{{ $comment->content }}</p>
            </div>

            <x-mobile.comments :comments="$comment->childComments" class="ms-4" />
        @endforeach
    </div>
@endif


@if(isset($hadithId))
    <x-mobile.add-comment :hadith-id="$hadithId" />
@endif
