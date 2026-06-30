<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-crimson dark:bg-gray-200 border border-transparent rounded-full font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-red-600 dark:hover:text-gray-100 dark:hover:bg-crimson focus:bg-crimson dark:focus:bg-crimson active:bg-gray-900 dark:active:bg-red-600 focus:outline-none focus:ring-2 focus:ring-crimson focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
