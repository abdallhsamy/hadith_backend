<x-layouts.mobile.default>
    @section('title', __('general.reset_password'))

    <div  class="mb-3 flex items-center justify-between pb-2 border-b">
        <h1 class="text-3xl font-bold">{{ __('general.reset_password') }}</h1>
        {{--        <p class="text-sm text-gray-500 uppercase font-bold">{{ \Carbon\Carbon::today()->translatedFormat('D d, M') }}</p>--}}

    </div>

    <form x-data="reset_password" dir="ltr" action="{{ route('postResetPassword') }}" method="post" class="my-4">
        @csrf
        <input hidden name="hash" >

        <div class="flex flex-col gap-y-2 w-full">
            <label for="hash" class="">{{ __('general.token') }}</label>
            <div class="flex w-full">
                <input
                    name="hash"
                    id="hash"
                    type="text"
                    autocomplete="off"
                    value="{{ $hash }}"
                    class="bg-shade h-12 px-2 border border-gray-300 @error('hash') border-red-300 @enderror text-gray-90 rounded-md w-full" />
            </div>
            @error('hash')
            <small id="hashHelp" class="form-text -mt-3 text-sm text-red-700 dark:text-red-400">{{ $message }}</small>
            @enderror
        </div>

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
                        value="{{ $user->email }}"
                        readonly
                        disabled
                        class="bg-shade h-12 px-2 border border-gray-300 @error('email') border-red-300 @enderror text-gray-90 rounded-md w-full" />
                </div>
                @error('email')
                <small id="emailHelp" class="form-text -mt-3 text-sm text-red-700 dark:text-red-400">{{ $message }}</small>
                @enderror
            </div>

            <div class="flex flex-col gap-y-2 w-full">
                <label for="password" class="">{{ __('general.new_password') }}</label>
                <div class="flex w-full">
                    <input
                        name="password"
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


            <div class="flex flex-col gap-y-2 w-full">
                <label for="password_confirmation" class="">{{ __('general.password_confirmation') }}</label>
                <div class="flex w-full">
                    <input
                        name="password_confirmation"
                        id="password_confirmation"
                        type="password"
                        placeholder="********"
                        autocomplete="off"
                        class="bg-shade h-12 px-2 border border-gray-300 @error('password_confirmation') border-red-300 @enderror text-gray-90 rounded-s-md w-full" />
                    <div @click="togglePasswordShow" class="cursor-pointer flex items-center justify-center bg-shade h-12 w-12 px-2   border-y border-e border-gray-300 text-gray-90 rounded-e-md">
                        😌
                    </div>
                </div>
                @error('password_confirmation')
                <small id="password_confirmationHelp" class="form-text -mt-3 text-sm text-red-700 dark:text-red-400">{{ $message }}</small>
                @enderror
            </div>


            {{--            <div class="flex flex-col gap-y-2 w-full">--}}
            {{--                <label for="remember" class="">--}}
            {{--                    <input type="checkbox" name="remember">--}}
            {{--                    {{ __('general.remember_me') }}--}}
            {{--                </label>--}}
            {{--                @error('remember')--}}
            {{--                <small id="rememberHelp" class="form-text -mt-3 text-sm text-red-700 dark:text-red-400">{{ $message }}</small>--}}
            {{--                @enderror--}}
            {{--            </div>--}}



            <button class="text-white bg-primary mt-4 h-12 px-2 rounded-md w-full" type="submit">{{ __('general.reset_password') }}</button>
        </div>
    </form>

    <br>

{{--    <div class="flex flex-col gap-2 ">--}}
{{--        <div>--}}
{{--            {{ __('general.already_have_account') }} <a href="#" class="font-bold">{{ __('general.login_here') }}</a>--}}
{{--        </div>--}}
{{--    </div>--}}



    @push('scripts')
        <script>
            document.addEventListener("alpine:init", () => {
                Alpine.data("reset_password", () => ({
                    togglePasswordShow() {
                        ['#password', '#password_confirmation'].forEach(function (item) {
                            const passwordField = document.querySelector(item)
                            if(passwordField.getAttribute('type') === 'password') {
                                passwordField.setAttribute('type', 'text')
                                passwordField.nextElementSibling.innerHTML = '🧐'
                            } else {
                                passwordField.setAttribute('type', 'password')
                                passwordField.nextElementSibling.innerHTML = '😌'
                            }
                        })
                    },
                }));
            });
        </script>
    @endpush

</x-layouts.mobile.default>
