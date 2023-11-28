@props([
    'hadithId',
    'parentId' => null,
    'class' => ''
])

@auth()
    <div class="mt-8 w-full">
        <form action="{{ route('mobile.hadiths.postComment', $hadithId) }}" method="post">
            @csrf
            <div class="flex flex-col items-center justify-between gap-4">
                <div class="relative flex flex-col gap-y-2 w-full">
                    <div class="absolute top-0 ltr:left-0 rtl:right-0 border border-shade rounded-xl -mt-4 ms-4">
                        <label for="comment" class=" bg-shade border border-white px-4 rounded-xl font-bold">{{ __('general.add_comment') }}</label>

                    </div>
                    <div class="flex w-full">
                            <textarea
                                name="comment"
                                required
                                id="comment"
                                rows="5"
                                class="bg-shade px-2 border border-gray-300 @error('comment') border-red-300 @enderror text-gray-90 rounded-md w-full" ></textarea>
                    </div>
                    @error('comment')
                    <small id="commentHelp" class="form-text -mt-3 text-sm text-red-700 dark:text-red-400">{{ $message }}</small>
                    @enderror
                </div>

                <div class="flex flex-col gap-y-2 w-full">
                    <label for="hide_author" class="">
                        <input type="checkbox" class="form-input rounded-full w-2 h-2" name="hide_author">
                        {{ __('general.hide_my_name') }}
                    </label>
                    @error('hide_author')
                    <small id="hide_authorHelp" class="form-text -mt-3 text-sm text-red-700 dark:text-red-400">{{ $message }}</small>
                    @enderror
                </div>
                <button class="text-white bg-primary py-2 px-4 rounded-xl " type="submit">{{ __('general.comment') }}</button>

            </div>
        </form>
    </div>

@endauth
