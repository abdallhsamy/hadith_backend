<x-layouts.mobile.default>
    @section('title', __('general.forget_password'))

    <div  class="mb-3 flex items-center justify-between pb-2 border-b">
        <h1 class="text-3xl font-bold">{{ __('general.forget_password') }}</h1>
        {{--        <p class="text-sm text-gray-500 uppercase font-bold">{{ \Carbon\Carbon::today()->translatedFormat('D d, M') }}</p>--}}

    </div>

    <form x-data="forget_password" dir="ltr" action="{{ route('postForgetPassword') }}" method="post" class="my-4">
        @csrf
        <div class="flex flex-col items-center justify-between gap-4">
            <div class="flex flex-col gap-y-2 w-full">
                <label for="email" class="">{{ __('general.email') }}</label>
                <div class="flex w-full">
                    <input
                        name="email"
                        id="email"
                        type="email"
                        placeholder="your@gmail.com"
                        autocomplete="email"
                        class="bg-shade h-12 px-2 border border-gray-300 @error('email') border-red-300 @enderror text-gray-90 rounded-md w-full" />
                </div>
                @error('email')
                <small id="emailHelp" class="form-text -mt-3 text-sm text-red-700 dark:text-red-400">{{ $message }}</small>
                @enderror
            </div>

            <button class="text-white bg-primary mt-4 h-12 px-2 rounded-md w-full" type="submit">{{ __('general.forget_password') }}</button>
        </div>
    </form>

    <br>

    <div class="flex flex-col gap-2 ">
        <div>
            {{ __('general.remember_password_question') }} <a href="{{ route('login') }}" class="font-semibold">{{ __('general.login') }}</a>
        </div>
        <div>
            {{ __('general.dont_have_account_yet_question') }} <a href="{{ route('register') }}" class="font-bold">{{ __('general.get_free_account') }}</a>
        </div>
    </div>
</x-layouts.mobile.default>
