<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/style.css', 'resources/js/script.js', 'resources/js/registrationFE.js'])
    </head>
    <body class="font-sans antialiased text-gray-900">
        <div class="sm:pt-0 dark:bg-gray-900 relative flex flex-col items-center justify-center min-h-screen pt-6 bg-gray-100" id="guess-body">
            <div class="z-20">
                <a href="{{ env('APP_URL') }}">
                     <img src="{{ asset('images/coe.png') }}" alt="" width="100px" height="100px">
                    <!-- <x-application-logo class="w-20 h-20 text-gray-500 fill-current" /> -->
                </a>
            </div>

            <div class="xs:max-w-md bg-white/50 dark:bg-white/10 rounded-3xl backdrop-blur-2xl z-10 w-full px-6 py-16 mt-6 overflow-hidden transform -translate-y-16 shadow-[inset_0_0_5px_rgba(255,255,255,0.4)] max-w-[90%]">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
