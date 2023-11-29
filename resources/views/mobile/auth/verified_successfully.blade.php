<x-layouts.mobile.default>
    @section('title', $user->name .' | '. __('general.profile'))

    <div class="flex flex-col gap-4 text-justify">
        <div class="flex items-center justify-between gap-4">
            <h1 class="text-xl font-bold">{{ __('general.profile') }}</h1>
        </div>



        <div class="flex flex-col items-center justify-center gap-4">
            <p style="margin: 0 auto 2rem;
                          line-height: 2rem;
                          text-align: center;">
                {{ __('general.hello') }}
                <strong>{{ $user->name }}</strong>
                <br>

                <span style="color: #007258">
                    {{ __('general.account_verified_successfully') }}
                </span>
                <br>
                {{ __('general.thank_you') }}



            </p>
            <a href="{{ url()->to('/') }}" class="py-2 px-6 rounded-md bg-primary_light text-white">{{ __('general.go_to_home_page') }}</a>
        </div>

    </div>
</x-layouts.mobile.default>
