@if(session()->has('success'))
    <script>
        window.addEventListener("load", (event) => {
            const toast = swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                // padding: '1em',
                customClass: 'sweet-alerts',
            });

            toast.fire({
                icon: 'success',
                title: "{{ session()->get('success') }}",
                // padding: '1em',
                customClass: 'sweet-alerts',
            });
        });
    </script>
@endif
