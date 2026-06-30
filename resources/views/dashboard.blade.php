<x-app-layout>
    <x-slot name="header">
        <h2 class="text-crimson dark:text-gray-200 text-xl font-semibold leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl lg:px-8 px-6 mx-auto">
            <div class="max-w-[1000px] bg-white/40 dark:bg-white/10 backdrop-blur-2xl overflow-hidden shadow-[inset_0_0_5px_rgba(255,255,255,0.4)] rounded-2xl mx-auto">
                <div class="text-crimson dark:text-gray-100 p-6 text-lg font-semibold uppercase">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
    <div>
        <div class="lg:px-8 px-6 mx-auto">
            <div class="max-w-[1000px] bg-white/40 dark:bg-white/10 backdrop-blur-2xl overflow-hidden shadow-[inset_0_0_5px_rgba(255,255,255,0.4)] rounded-xl mx-auto">
                <div class="dark:text-gray-100 p-6 text-gray-900" id="dashboard-bg">
                    <h1 class="dark:text-gray-200 text-crimson font-semibold">Welcome to the Dashboard</h1>
                    <div class="xs:grid-cols-4 xs:grid-rows-1 justify-items-center grid grid-cols-2 grid-rows-2 gap-0">
                        <a href="{{ route('readQR') }}">
                            <div class="hover:scale-105 rounded-xl dark:bg-gray-900 active:shadow-none active:scale-100 lg:h-48 lg:w-40 md:h-36 md:w-32 w-28 flex flex-col items-center h-32 p-6 my-4 transition transform bg-white shadow-[inset_0_0_5px_rgba(255,255,255,0.4)]">
                                <p class="lg:block dark:text-gray-200 hidden text-xs text-gray-500">Scan QR Code</p>
                                <img src="{{ asset('images/read.png') }}" alt="Scan QR"
                                class="dark:filter dark:invert h-24 m-2"
                                >
                                <p class="dark:text-gray-200 font-extrabold text-center">READ</p>
                            </div>
                        </a>
                        <a href="{{ route('document.create') }}">
                            <div class="rounded-xl dark:bg-gray-900 active:shadow-none lg:h-48 lg:w-40 md:h-36 md:w-32 w-28 hover:scale-105 flex flex-col items-center h-32 p-6 my-4 transition transform bg-white shadow-[inset_0_0_5px_rgba(255,255,255,0.4)]">
                                <p class="lg:block dark:text-gray-200 hidden text-xs text-gray-500">Create QR Code</p>
                                <img src="{{ asset('images/generate.png') }}" alt="Generate QR"
                                class="dark:filter dark:invert h-24 m-2"
                                >
                                <p class="dark:text-gray-200 font-extrabold text-center">GENERATE</p>
                            </div>
                        </a>
                        <a href="{{ route('document.search') }}">
                            <div class="rounded-xl dark:bg-gray-900 active:shadow-none lg:h-48 lg:w-40 md:h-36 md:w-32 w-28 hover:scale-105 active:scale-100 flex flex-col items-center h-32 p-6 my-4 transition transform bg-white shadow-[inset_0_0_5px_rgba(255,255,255,0.4)]">
                                <p class="lg:block dark:text-gray-200 hidden text-xs text-gray-500">Search Documents</p>
                                <img src="{{ asset('images/search.png') }}" alt="Search"
                                class="dark:filter dark:invert h-24 m-2"
                                >
                                <p class="dark:text-gray-200 font-extrabold text-center">SEARCH</p>
                            </div>
                        </a>
                        <a href="{{ route('document.myDocs') }}">
                            <div class="rounded-xl dark:bg-gray-900 active:shadow-none lg:h-48 lg:w-40 md:h-36 md:w-32 w-28 hover:scale-105 active:scale-100 flex flex-col items-center h-32 p-6 my-4 transition transform bg-white shadow-[inset_0_0_5px_rgba(255,255,255,0.4)]">
                                <p class="lg:block dark:text-gray-200 hidden text-xs text-gray-500">Your Documents</p>
                                <img src="{{ asset('images/document.png') }}" alt="Document"
                                class="dark:filter dark:invert h-24 m-2"
                                >
                                <p class="dark:text-gray-200 font-extrabold text-center">DOCUMENTS</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
