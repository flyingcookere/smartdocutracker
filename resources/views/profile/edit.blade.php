<x-app-layout>
    <x-slot name="header">
        <h2 class="dark:text-gray-200 text-xl font-semibold leading-tight text-gray-800">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12" id="guess-body">
        <div class="max-w-7xl sm:px-6 lg:px-8 mx-auto space-y-6">
            <div class="sm:p-8 dark:bg-white/10 sm:rounded-2xl bg-white/50 backdrop-blur-2xl p-4 sm:shadow-[inset_0_0_5px_rgba(255,255,255,0.4)] shadow-none">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="sm:p-8 dark:bg-white/10 sm:rounded-2xl bg-white/50 backdrop-blur-2xl p-4 sm:shadow-[inset_0_0_5px_rgba(255,255,255,0.4)] shadow-none">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="sm:p-8 dark:bg-white/10 sm:rounded-2xl bg-white/50 backdrop-blur-2xl p-4 sm:shadow-[inset_0_0_5px_rgba(255,255,255,0.4)] shadow-none">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
