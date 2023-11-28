<x-layouts.mobile.default>
    <div x-data="profile" class="flex flex-col gap-4 text-justify">
        <div class="flex items-center justify-between gap-4">
            <h1 class="text-xl font-bold">{{ __('general.profile') }}</h1>
        </div>



        <div class="flex flex-col gap-4">
            <form  action="{{ route('mobile.profile') }}" method="post" class="my-4">
                @csrf
                <div class="flex flex-col gap-4">

                    <div class="flex items-center justify-between">

                        <div class="relative">
                            <label for="avatar" class="cursor-pointer flex items-center gap-4 px-6 py-4 before:border-gray-400/60 hover:before:border-gray-300 group dark:before:bg-darker dark:hover:before:border-gray-500 before:bg-gray-100 dark:before:border-gray-600 before:absolute before:inset-0 before:rounded-3xl before:border before:border-dashed before:transition-transform before:duration-300 hover:before:scale-105 active:duration-75 active:before:scale-95">
                                {{--                        {{ __('general.avatar') }}--}}
                                <div class="w-max relative">
                                    <img class="w-12" src="{{ asset('assets/images/upload-circle.svg') }}" alt="file upload icon" width="512" height="512">
                                </div>
                                <div class="relative">
                              <span class="block text-base font-semibold relative text-blue-900 dark:text-white group-hover:text-primary">
                                  {{ __('general.upload_image') }}
                              </span>
                                    <span class="mt-0.5 block text-sm text-gray-500 dark:text-gray-400">Max 20 MB</span>
                                </div>
                            </label>
                            <div class="flex w-full">
                                <input
                                    hidden
                                    name="avatar"
                                    id="avatar"
                                    type="file"
                                    autocomplete="avatar"
                                    value="{{ old('avatar', $user->avatar) }}"
                                    class="bg-shade h-12 px-2 border border-gray-300 @error('avatar') border-red-300 @enderror text-gray-90 rounded-md w-full" />
                            </div>
                            @error('avatar')
                            <small id="avatarHelp" class="form-text -mt-3 text-sm text-red-700 dark:text-red-400">{{ $message }}</small>
                            @enderror
                        </div>

                        <img src="{{ $user->avatar }}" alt="{{ $user->name }}" class="w-20 rounded-lg">
                    </div>

                <div class="flex flex-col gap-y-2 w-full">
                    <label for="name" class="">{{ __('general.name') }}</label>
                    <div class="flex w-full">
                        <input
                            name="name"
                            id="name"
                            type="text"
                            autocomplete="name"
                            value="{{ old('name', $user->name) }}"
                            class="bg-shade h-12 px-2 border border-gray-300 @error('name') border-red-300 @enderror text-gray-90 rounded-md w-full" />
                    </div>
                    @error('name')
                    <small id="nameHelp" class="form-text -mt-3 text-sm text-red-700 dark:text-red-400">{{ $message }}</small>
                    @enderror
                </div>


                <div class="flex flex-col gap-y-2 w-full">
                    <label for="email" class="">{{ __('general.email') }}</label>
                    <div class="flex w-full">
                        <input
                            name="email"
                            id="email"
                            type="email"
                            placeholder="your@gmail.com"
                            autocomplete="email"
                            value="{{ old('email', $user->email) }}"
                            class="bg-shade h-12 px-2 border border-gray-300 @error('email') border-red-300 @enderror text-gray-90 rounded-md w-full" />
                    </div>
                    @error('email')
                    <small id="emailHelp" class="form-text -mt-3 text-sm text-red-700 dark:text-red-400">{{ $message }}</small>
                    @enderror
                </div>



                </div>
                <button class="text-white bg-primary mt-4 h-12 px-2 rounded-md w-full" type="submit">{{ __('general.update') }}</button>
            </form>

        </div>




{{--        <div class="flex flex-col gap-y-2 w-full">--}}
{{--            <label for="password" class="">{{ __('general.password') }}</label>--}}
{{--            <div class="flex w-full">--}}
{{--                <input--}}
{{--                    name="password"--}}
{{--                    id="password"--}}
{{--                    type="password"--}}
{{--                    placeholder="********"--}}
{{--                    autocomplete="off"--}}
{{--                    class="bg-shade h-12 px-2 border border-gray-300 @error('password') border-red-300 @enderror text-gray-90 rounded-s-md w-full" />--}}
{{--                <div @click="togglePasswordShow" class="cursor-pointer flex items-center justify-center bg-shade h-12 w-12 px-2   border-y border-e border-gray-300 text-gray-90 rounded-e-md">--}}
{{--                    😌--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            @error('password')--}}
{{--            <small id="passwordHelp" class="form-text -mt-3 text-sm text-red-700 dark:text-red-400">{{ $message }}</small>--}}
{{--            @enderror--}}
{{--        </div>--}}


{{--        <div class="flex flex-col gap-y-2 w-full">--}}
{{--            <label for="password_confirmation" class="">{{ __('general.password_confirmation') }}</label>--}}
{{--            <div class="flex w-full">--}}
{{--                <input--}}
{{--                    name="password_confirmation"--}}
{{--                    id="password_confirmation"--}}
{{--                    type="password"--}}
{{--                    placeholder="********"--}}
{{--                    autocomplete="off"--}}
{{--                    class="bg-shade h-12 px-2 border border-gray-300 @error('password_confirmation') border-red-300 @enderror text-gray-90 rounded-s-md w-full" />--}}
{{--                <div @click="togglePasswordShow" class="cursor-pointer flex items-center justify-center bg-shade h-12 w-12 px-2   border-y border-e border-gray-300 text-gray-90 rounded-e-md">--}}
{{--                    😌--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            @error('password_confirmation')--}}
{{--            <small id="password_confirmationHelp" class="form-text -mt-3 text-sm text-red-700 dark:text-red-400">{{ $message }}</small>--}}
{{--            @enderror--}}
{{--        </div>--}}

    </div>

    @push('scripts')
        <script>
            document.addEventListener("alpine:init", () => {
                Alpine.data("profile", () => ({
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
