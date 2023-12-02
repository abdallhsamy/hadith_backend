@if(count($availableLanguages) > 0 && !\Illuminate\Support\Facades\Route::is('mobile.hadiths.show'))

<div class="relative inline-block w-auto">
    <button id="languageBtn" class="text-primary bg-white px-2 py-1 rounded-lg border border-primary hover:bg-shade">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
            <g fill="#006837">
                <path d="M17,11.94q-.16.626-.922,3.091h1.86q-.719-2.309-.808-2.612C17.072,12.218,17.028,12.058,17,11.94Z" fill="#006837"></path>
                <path d="M22,8H12a2,2,0,0,0-2,2v9a2,2,0,0,0,2,2h6l4,3V21a2,2,0,0,0,2-2V10A2,2,0,0,0,22,8ZM18.819,18,18.3,16.3H15.7L15.181,18H13.55l2.52-7.168h1.85L20.45,18Z" fill="#006837"></path>
                <path d="M12,0H2A2,2,0,0,0,0,2v9a2,2,0,0,0,2,2v3l4-3H9V10a2.828,2.828,0,0,1,.04-.393A9.23,9.23,0,0,1,7.056,8.529,10.268,10.268,0,0,1,3.874,10a4.633,4.633,0,0,0-.768-1.415A8.7,8.7,0,0,0,5.944,7.537,7,7,0,0,1,4.913,6.074a7.077,7.077,0,0,1-.552-1.367c-.471,0-.743.016-1.143.048V3.308a9.853,9.853,0,0,0,1.159.056H6.145v-.48a2.482,2.482,0,0,0-.048-.5H7.7a2.445,2.445,0,0,0-.048.487v.488h1.9a9.774,9.774,0,0,0,1.159-.056V4.755c-.352-.032-.664-.048-1.135-.048A6.278,6.278,0,0,1,9.039,6.25a5.924,5.924,0,0,1-.888,1.3A6.958,6.958,0,0,0,9.617,8.2,2.987,2.987,0,0,1,12,7h2V2A2,2,0,0,0,12,0Z"></path>
                <path d="M7.016,6.642a4.51,4.51,0,0,0,1-1.935H5.9A4.562,4.562,0,0,0,7.016,6.642Z"></path>
            </g>
        </svg>
    </button>

    <div id="languageMenu" class="hidden absolute ltr:right-0 rtl:left-0 z-10 mt-2 w-auto origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
        <div class="py-1 max-h-96 overflow-y-auto" role="none">
            <!-- Active: "bg-gray-100 text-gray-900", Not Active: "text-gray-700" -->
            @foreach($availableLanguages as $language)
                <a
                    href="{{ route('change-language', $language->code) }}"
                    @class([
                            'bg-gray-100' => app()->getLocale() === $language->code,
                            'text-gray-900' => app()->getLocale() === $language->code,
                            'text-gray-700' =>  app()->getLocale() !== $language->code,
                            'block',
                            'px-4',
                            'py-2',
                            'text-sm',
                            'hover:bg-gray-100',
                            'hover:text-gray-900',
                            'change-language-menu-item'
                   ])
                    role="menuitem"
                    tabindex="-1"
                    id="menu-item-{{ $language->code }}"
                >{{ $language->native }}</a>
            @endforeach
        </div>
    </div>
</div>

    @push('scripts')
        <script>
            document.querySelector('#languageBtn').addEventListener('click', function() {
                document.querySelector('#languageMenu').classList.toggle('hidden')
            });
            document.querySelectorAll('.change-language-menu-item').forEach(function(item) {
                item.addEventListener('click', function(event) {
                    event.preventDefault();
                    axios
                        .get(this.getAttribute('href'))
                        .then((response) => {
                            if(response.status === 204) {
                                location.reload()
                            }
                            // console.log(response.status);
                            // console.log(response.data);
                        })
                        .catch(error => console.log(error))
                })
            })
        </script>
    @endpush
@endif
