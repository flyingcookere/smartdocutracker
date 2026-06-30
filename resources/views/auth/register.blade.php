
<x-guest-layout>
  <form method="POST" action="{{ route('register') }}">
    @csrf

    <div>
      <x-input-label for="name" :value="__('Name')" />
      <x-text-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
      <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <div class="mt-4">
      <x-input-label for="email" :value="__('Email')" />
      <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')" required autocomplete="username" />
      <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>

    <div class="mt-4" x-data="{ department: '', error: '' }">
      <x-input-label for="department" value="Department" />
      <select name="department" id="department" placeholder="Department"
      class="text-crimson bg-gray-200/50 dark:bg-gray-900/50 dark:text-gray-300 focus:border-crimson dark:focus:border-red-600 focus:ring-crimson dark:focus:ring-red-600 w-full text-lg border-transparent rounded-full shadow-sm"
      >
        <option value="" disabled selected>Select Department</option>
        <option value="College of Engineering">College of Engineering</option>
        <option value="Office of The President">Office of the President</option>
        <option value="Accounting Office">Accounting Office</option>
        <option value="Office of The Chancellor">Office of The Chancellor</option>
        <option value="Office of The VPAA">Office of The VPAA</option>
      </select>
      <x-input-error :messages="$errors->get('department')" class="mt-2" />
      <p x-show="error" x-text="error" class="mt-2 text-red-500"></p>
    </div>

    <div class="mt-4">
      <x-input-label for="password" :value="__('Password')" />
      <x-text-input id="password" class="block w-full mt-1" type="password" name="password" required autocomplete="new-password" />
      <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <div class="mt-4">
      <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
      <x-text-input id="password_confirmation" class="block w-full mt-1" type="password" name="password_confirmation" required autocomplete="new-password" />
      <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
    </div>

    <div class="flex items-center justify-end mt-4">
      <a class="dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 text-sm text-gray-600 underline rounded-md" href="{{ route('login') }}">
        {{ __('Already registered?') }}
      </a>
      <!-- <button @click.prevent="validateForm">Submit</button> -->
      <x-primary-button class="ms-4" @click.prevent="validateForm">
        {{ __('Register') }}
      </x-primary-button>
    </div>
  </form>
</x-guest-layout>