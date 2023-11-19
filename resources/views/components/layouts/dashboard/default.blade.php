<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name') }} | @yield('page_title')</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    <script src="https://unpkg.com/feather-icons"></script>

    @stack('css')
</head>
<body>
<div class="w-full h-screen bg-primary flex">
    <x-layouts.dashboard.sidebar/>
    <div class="bg-shade rounded-xl w-full my-4 me-4 flex flex-col divide-y relative">
        <nav class="h-12">navbar</nav>
        <main>
            <div class="text-white">dddddddddddd</div>
            {{ $slot }}
        </main>
        <footer class="h-12 w-full absolute bottom-0 text-center">footer</footer>

    </div>


</div>

<script>
    feather.replace();
</script>
</body>
</html>
