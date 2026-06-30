<section>
    <header>
        <h2 class="dark:text-gray-100 text-lg font-extrabold text-gray-900">
            {{ __('Profile Information') }}
        </h2>

        <p class="dark:text-gray-400 mt-1 text-sm font-normal text-black">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="block w-full mt-1" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="block w-full mt-1" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="dark:text-gray-200 mt-2 text-sm text-gray-800">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 text-sm text-gray-600 underline rounded-md">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="dark:text-green-400 mt-2 text-sm font-medium text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div>
             <x-input-label for="department" :value="__('Department')" />
            <select name="department" id="department" placeholder=""
            class="text-crimson bg-gray-200/50 dark:bg-gray-900/50 dark:text-white focus:border-crimson dark:focus:border-red-600 focus:ring-crimson dark:focus:ring-red-600 w-full max-w-xl my-1 text-lg border-transparent rounded-full shadow-sm"
            >
                        <option value="" disabled selected>{{ Auth::user()->department }}</option>
                        <option value="College of Engineering">College of Engineering</option>
                        <option value="Office of The President">Office of the President</option>
                        <option value="Accounting Office">Accounting Office</option>
                        <option value="Office of The Chancellor">Office of The Chancellor</option>
                </select>
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="dark:text-gray-400 text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
