@if(config('analytics.gtag_token'))
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-HDKEHH1Q43"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', "{{ config('analytics.gtag_token') }}");
    </script>
@endif

