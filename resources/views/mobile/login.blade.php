<x-layouts.mobile.default>

    <div  class="mb-3 flex items-center justify-between pb-2 border-b">
        <h1 class="text-3xl font-bold">{{ __('general.login') }}</h1>
        {{--        <p class="text-sm text-gray-500 uppercase font-bold">{{ \Carbon\Carbon::today()->translatedFormat('D d, M') }}</p>--}}

    </div>

    <form x-data="login" dir="ltr" action="{{ route('postLogin') }}" method="post" class="my-4">
        @csrf

        <div class="flex flex-col items-center justify-between gap-4">
{{--            <label for="email">{{ __('general.email') }}</label>--}}
{{--            <input id="email" name="email" value="{{ old('email') }}" type="email" class=" bg-shade h-12 px-2 border border-gray-300 @error('email') border-red-300 @enderror text-gray-90 rounded-md w-full" placeholder="your@gmail.com">--}}

            @error('email')
            <small id="emailHelp" class="form-text -mt-3 text-sm text-red-700 dark:text-red-400">{{ $message }}</small>
            @enderror



            <div class="flex flex-col gap-y-2 w-full">
                <label for="email" class="">{{ __('general.email') }}</label>
                <div class="flex w-full">
                    <input
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

            <div class="flex flex-col gap-y-2 w-full">
                <label for="password" class="">{{ __('general.password') }}</label>
                <div class="flex w-full">
                    <input
                        id="password"
                        type="password"
                        placeholder="********"
                        autocomplete="off"
                        class="bg-shade h-12 px-2 border border-gray-300 @error('password') border-red-300 @enderror text-gray-90 rounded-s-md w-full" />
                    <div @click="togglePasswordShow" class="cursor-pointer flex items-center justify-center bg-shade h-12 w-12 px-2   border-y border-e border-gray-300 text-gray-90 rounded-e-md">
                        😌
                    </div>
                </div>
                @error('password')
                <small id="passwordHelp" class="form-text -mt-3 text-sm text-red-700 dark:text-red-400">{{ $message }}</small>
                @enderror
            </div>



            <button class="text-white bg-primary mt-4 h-12 px-2 rounded-md w-full" type="submit">{{ __('general.login') }}</button>
        </div>
    </form>

    <br>

    <div class="flex flex-col gap-2 ">
        <div>
            {{ __('general.forget_password_question') }} <a href="#" class="font-semibold">{{ __('general.reset_password') }}</a>
        </div>
        <div>
            {{ __('general.dont_have_account_yet_question') }} <a href="#" class="font-bold">{{ __('general.get_free_account') }}</a>
        </div>
    </div>



    @push('scripts')
        <script>
            document.addEventListener("alpine:init", () => {
                Alpine.data("login", () => ({
                    togglePasswordShow() {
                        const passwordField = document.querySelector('#password')
                        if(passwordField.getAttribute('type') === 'password') {
                            passwordField.setAttribute('type', 'text')
                            passwordField.nextElementSibling.innerHTML = '🧐'
                        } else {
                            passwordField.setAttribute('type', 'password')
                            passwordField.nextElementSibling.innerHTML = '😌'
                        }
                    },
                }));
            });
        </script>
    @endpush

</x-layouts.mobile.default>
