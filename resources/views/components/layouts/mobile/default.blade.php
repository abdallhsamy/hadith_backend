
<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
</head>
<body>


<div class="bg-white text-gray-800 rounded-xl shadow-lg overflow-hidden relative flex" style="width:100%;height:100vh;">
    <div class="bg-white h-full w-full px-5 pt-6 pb-20 overflow-y-auto">
        <div class="mb-3 flex items-center justify-between">
            <x-logo class="w-24"/>
            @guest()
                <a href="#login" class="text-white bg-primary px-2 py-1 rounded-lg">login</a>
            @endguest
        </div>
        {{ $slot }}
    </div>

    <x-layouts.mobile.app-bar/>
</div>
</body>
</html>
