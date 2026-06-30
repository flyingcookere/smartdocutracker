@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-bold text-lg text-crimson dark:text-gray-100 dark:text-gray-300']) }}>
    {{ $value ?? $slot }}
</label>
