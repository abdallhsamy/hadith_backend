{{--@push('scripts')--}}

{{--@endpush--}}

<script>
    const toggleBookmarkButtons = document.querySelectorAll('.toggle-bookmark')

    if(toggleBookmarkButtons) {
        toggleBookmarkButtons.forEach(function(item) {
            item.addEventListener('click', function(event) {

                let icon =  'info'
                let title = "{{ __('general.something_went_wrong') }}"

                const toast = swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    padding: '1em',
                    customClass: 'sweet-alerts',
                });

                axios.get(`{{ route('mobile.hadiths.bookmark', ':hadithId') }}`.replace(':hadithId', item.getAttribute('data-id')))
                    .then(response => {
                        if (response.status == 200) {
                            if (response.data.bookmarked) {
                                item.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                            <g fill="none">
                                                <path opacity=".3" d="M7 17.97l5-2.15 5 2.15V5H7v12.97z" fill="#f7f7f7"></path>
                                                <path d="M17 3H7c-1.1 0-2 .9-2 2v16l7-3 7 3V5c0-1.1-.9-2-2-2zm0 14.97l-5-2.14-5 2.14V5h10v12.97z" fill="#f7f7f7"></path>
                                            </g>
                                        </svg>`
                            } else {
                                item.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                            <g fill="none">
                                                <path d="M17 3H7c-1.1 0-2 .9-2 2v16l7-3 7 3V5c0-1.1-.9-2-2-2zm0 15l-5-2.18L7 18V5h10v13z" fill="#f7f7f7"></path>
                                            </g>
                                        </svg>`
                            }

                            title = response.data.message
                            icon =  'success';
                        }
                    }).catch((error) => {
                    if (error.response.status === 404) {
                        icon =  'error';
                        title =  error.response.statusText;
                    }
                }).finally(function () {
                    toast.fire({
                        icon: icon,
                        title: title,
                        padding: '1em',
                        customClass: 'sweet-alerts',
                    });
                })
            })
        })
    }

</script>
