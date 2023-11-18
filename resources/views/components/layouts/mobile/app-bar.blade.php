<div id="app_bar" class="bg-white absolute bottom-0 w-full border-t border-gray-200 flex">
    <a href="{{ route('mobile.today') }}" class="app-bar-item flex flex-grow items-center justify-center p-2 text-primary hover:text-primary">
        <div class="text-center">
                    <span class="block h-8 text-3xl leading-8">
                        <i class="mdi mdi-newspaper-variant-outline"></i>
                    </span>
            <span class="block text-xs leading-none">{{ __('general.today') }}</span>
        </div>
    </a>

    <a href="{{ route('mobile.all') }}" class="app-bar-item flex flex-grow items-center justify-center p-2 text-gray-500 hover:text-primary">
        <div class="text-center">
                    <span class="block h-8 text-3xl leading-8">
                        <i class="mdi mdi-newspaper"></i>
                    </span>
            <span class="block text-xs leading-none">{{ __('general.all') }}</span>
        </div>
    </a>

    <a href="{{ route('mobile.categories') }}" class="app-bar-item flex flex-grow items-center justify-center p-2 text-gray-500 hover:text-primary">
        <div class="text-center">
                    <span class="block h-8 text-3xl leading-8">
                        <i class="mdi mdi-apps"></i>
                    </span>
            <span class="block text-xs leading-none">{{ __('general.categories') }}</span>
        </div>
    </a>

    <a href="{{ route('mobile.favorites') }}" class="app-bar-item flex flex-grow items-center justify-center p-2 text-gray-500 hover:text-primary">
        <div class="text-center">
                    <span class="block h-8 text-3xl leading-8">
                        <i class="mdi mdi-star-outline"></i>
                    </span>
            <span class="block text-xs leading-none">{{ __('general.favorites') }}</span>
        </div>
    </a>

    <a href="{{ route('mobile.search') }}" class="app-bar-item flex flex-grow items-center justify-center p-2 text-gray-500 hover:text-primary">
        <div class="text-center">
                    <span class="block h-8 text-3xl leading-8">
                        <i class="mdi mdi-magnify"></i>
                    </span>
            <span class="block text-xs leading-none">{{ __('general.search') }}</span>
        </div>
    </a>
</div>

@push('scripts')
    <script>
        addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.app-bar-item').forEach(function (item) {
                if(item.getAttribute('href') === window.location.href) {
                    item.classList.add('text-primary');
                    item.classList.remove('text-gray-500');
                } else {
                    item.classList.remove('text-primary');
                    item.classList.add('text-gray-500');
                }
            })
        })
    </script>
@endpush
