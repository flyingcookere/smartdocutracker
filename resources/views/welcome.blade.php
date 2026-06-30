<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ env('APP_NAME', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/style.css', 'resources/js/script.js'])

    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center justify-center min-h-screen flex-col" id="app-container">
        <div class="duration-750 lg:grow starting:opacity-0 flex items-center justify-center w-full transition-opacity opacity-100">
            <main class="min-h-[400px] rounded-2xl flex max-w-[335px] w-full flex-col-reverse justify-center lg:max-w-3xl lg:flex-row overflow-hidden shadow-[0_0_10px_rgba(255,255,255,0.4)] backdrop-blur-sm">
                <div class="lg:max-w-80 leading-[20px] p-6 pb-12 lg:p-10 bg-white/70 dark:bg-gray-900/80 dark:text-[#EDEDEC]">
                    <h1 class="font-droid dark:text-gray-100 lg:mb-56 text-2xl font-bold text-red-800">Know Where Your Documents Are, Instantly</h1>
                    <p class="font-droid dark:text-gray-100 font-bold text-red-800">Programmed by CpE3C-G5<h2>
                </div>
                <div class="flex-1 relative lg:pt-5 lg:-ml-px -mb-px lg:mb-0 rounded-t-lg lg:rounded-t-none lg:rounded-r-lg aspect-[335/376] lg:aspect-auto w-full lg:w-[438px] shrink-0 overflow-hidden bg-cover text-white text-center flex flex-col justify-center items-center font-droid" id="custom-box">
                    <!-- <div class="logo"></div> -->
                    <img src="{{ asset('images/bulsuLogo.png') }}" alt="Logo">
                    <div class="card-text flex flex-col items-center">
                        <h1 class="font-bold">Bulacan State University</h1>
                        <h3 class="mb-20 font-bold">Smart Document Tracker</h3>

                    @if (Route::has('login'))
                        @auth
                            <a
                                href="{{ url('/dashboard') }}"
                                class="w-fit px-4 py-1 font-sans font-bold bg-white text-crimson hover:text-red-600 dark:hover:border-[#3E3E3A] rounded-full leading-normal mb-5"
                            >
                                Dashboard
                            </a>
                        @else
                            <a
                                href="{{ route('login') }}"
                                class="w-fit px-4 py-1 font-sans font-bold bg-white text-crimson hover:text-red-600 dark:hover:border-[#3E3E3A] rounded-full leading-normal mb-5"
                            >
                                Sign In
                            </a>

                        @if (Route::has('register'))
                            <p class="font-sans">Don't Have An Account&#63;
                                <a
                                    href="{{ route('register') }}"
                                    class="w-fit hover:underline lg:no-underline px-0 py-0 font-sans font-bold text-white underline bg-transparent"
                                >
                                    Register
                                </a>
                            </p>
                            
                                @endif
                            @endauth
                        @endif
                    </div>
                </div>
            </main>
        </div>

        @if (Route::has('login'))
            <div class="h-14.5 hidden lg:block"></div>
        @endif
    </body>
</html>
