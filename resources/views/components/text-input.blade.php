@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-transparent text-crimson text-lg bg-gray-200/50 dark:bg-gray-900/50 focus:ring-[0.1px] dark:text-gray-300 focus:border-crimson dark:focus:border-red-600 focus:ring-crimson dark:focus:ring-red-600 rounded-full shadow-sm']) }}>
