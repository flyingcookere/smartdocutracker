<x-app-layout>
    <x-slot name="header">
        <h2 class="dark:text-gray-200 text-xl font-semibold leading-tight text-gray-800">
            {{ __('Search Documents') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="sm:max-w-xl w-full mx-auto px-4 4 4 4 max-w-[90%]">
            <div class="bg-white/40 dark:bg-white/10 backdrop-blur-2xl shadow-[inset_0_0_5px_rgba(255,255,255,0.4)] overflow-hidden rounded-3xl">
                <div class="dark:text-gray-100 flex flex-col items-center p-10 mb-10 text-gray-900">
                    <div class="z-20 p-8 m-2 rounded-full">
                        <img src="{{ asset('images/search-icon.png') }}" alt="" width="100px" height="100px" class="dark:filter dark:invert">
                    </div>
                    <form action="{{ route('document.search.submit') }}" method="POST" class="w-full">
                        @csrf
                        <div class="flex flex-col items-center w-full">
                        <input type="text" class="text-crimson dark:bg-gray-900/50 dark:text-gray-300 focus:border-crimson dark:focus:border-red-600 focus:ring-crimson dark:focus:ring-red-600 bg-gray-200/50 w-full py-3 mb-4 text-lg border-transparent rounded-full shadow-sm" name="uuid" placeholder="Document UUID" required><br><br>
                        <button type="submit" class="hover:bg-red-600 px-7 bg-crimson py-3 font-bold text-white rounded-full">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>