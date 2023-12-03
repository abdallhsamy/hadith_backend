@props([
    'hadithId',
    'comments' => [],
    'class' => '',
    'showControls' => false,
])

@if(count($comments) > 0)
    <div {{ $attributes->merge(['class' => 'flex flex-col justify-between gap-8 ' . $class ]) }}>
        @foreach($comments as $comment)

            <div class="relative bg-shade rounded-md w-full grow">
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
                @if($showControls & ! $comment->verified_at)
                    <div class="absolute top-0 ltr:right-0 rtl:left-0 -mt-4 me-4 border border-shade rounded-xl">
                        <div class="flex items-center justify-between gap-2 bg-shade border border-white rounded-xl p-1">
                            <button class="verify-btn" data-comment-id="{{ $comment->_id }}">
                                <i class="text-blue-500 text-sm" data-feather="toggle-left"></i>
                            </button>
                            <button class="delete-btn" data-comment-id="{{ $comment->_id }}">
                                <i class="text-red-500 text-sm" data-feather="trash"></i>
                            </button>
                        </div>
                    </div>

                    @endif
                <p class="text-justify p-4">{{ $comment->content }}</p>

                @auth()
                    <button data-comment-id="{{ $comment->_id }}" class="reply-btn absolute bottom-0 ltr:right-0 rtl:left-0 -mb-3 mx-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <g fill="none">
                                <path d="M20 2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14l4 4V4c0-1.1-.9-2-2-2zm0 15.17L18.83 16H4V4h16v13.17zM13 5h-2v4H7v2h4v4h2v-4h4V9h-4V5z" fill="#006837"></path>
                                <path opacity=".3" d="M4 4v12h14.83L20 17.17V4H4zm13 7h-4v4h-2v-4H7V9h4V5h2v4h4v2z" fill="#006837"></path>
                            </g>
                        </svg>
                    </button>
                @endauth
            </div>

            <x-mobile.comments :comments="$comment->childComments" class="ms-4" :show-controls="$showControls"  />
        @endforeach
    </div>
@endif


@if(isset($hadithId))
    <x-mobile.add-comment :hadith-id="$hadithId" />

    @once
        @push('scripts')
            <script>
                const replyBtns = document.querySelectorAll('.reply-btn')

                if (replyBtns.length) {
                    replyBtns.forEach(function(btn) {
                        btn.addEventListener('click', function() {
                            const commentId = this.getAttribute('data-comment-id')

                            let html = `<x-mobile.add-comment hadith-id="{{ $hadithId }}" parent-id="__parentId__"  />`
                            html = html.replaceAll('__parentId__', commentId)

                            btn.parentElement.innerHTML = btn.parentElement.innerHTML + html
                        })
                    })
                }

                @if($showControls)
                    const verifyBtns = document.querySelectorAll('.verify-btn')
                    if (verifyBtns.length) {
                        verifyBtns.forEach(function (verifyBtn) {
                            verifyBtn.addEventListener('click', function () {
                                if(!verifyBtn.getAttribute('data-comment-id')) {
                                    return;
                                }

                                const url = "{{ route('dashboard.comments.verify', ':commentId') }}".replace(':commentId', verifyBtn.getAttribute('data-comment-id'))
                                axios
                                    .get(url)
                                    .then((response) => {
                                        if (response.status === 204) {
                                            verifyBtn.innerHTML = `<i class="text-blue-200 text-sm" fill="#172554" data-feather="toggle-left"></i>`
                                            feather.replace();
                                            var parentContainer = verifyBtn.parentElement.parentElement
                                            parentContainer.style.transition = 'opacity 0.5s ease-in-out';
                                            parentContainer.style.opacity = 1;

                                            parentContainer.style.opacity = 0;

                                            parentContainer.addEventListener('transitionend', function () {
                                                parentContainer.remove();
                                            });
                                        }
                                    })
                            //
                            })
                        })
                    }


                const deleteBtns = document.querySelectorAll('.delete-btn')
                if (deleteBtns.length) {
                    deleteBtns.forEach(function (deleteBtn) {
                        deleteBtn.addEventListener('click', function () {
                            if(!deleteBtn.getAttribute('data-comment-id')) {
                                return;
                            }

                            const url = "{{ route('dashboard.comments.destroy', ':commentId') }}".replace(':commentId', deleteBtn.getAttribute('data-comment-id'))
                            axios
                                .delete(url)
                                .then((response) => {
                                    if (response.status === 204) {
                                        deleteBtn.innerHTML = `<i class="text-blue-200 text-sm" fill="#172554" data-feather="toggle-left"></i>`
                                        feather.replace();
                                        var parentContainer = deleteBtn.parentElement.parentElement.parentElement
                                        parentContainer.style.transition = 'opacity 0.5s ease-in-out';
                                        parentContainer.style.opacity = 1;

                                        parentContainer.style.opacity = 0;

                                        parentContainer.addEventListener('transitionend', function () {
                                            parentContainer.remove();
                                        });
                                    }
                                })
                            //
                        })
                    })
                }
                @endif
            </script>
        @endpush
    @endonce
@endif


