@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center px-1 pt-1 border-b-4 border-orange-400 dark:border-orange-600 text-sm font-medium leading-5 text-gray-200 dark:text-gray-100 focus:outline-none focus:border-orange-700 transition duration-150 ease-in-out'
            : 'inline-flex items-center px-1 pt-1 border-b-4 border-transparent text-sm font-medium leading-5 text-gray-200 dark:text-gray-400 hover:text-orange-400 dark:hover:text-orange-300 hover:border-orange-400 dark:hover:border-orange-700 focus:outline-none focus:text-orange-700 dark:focus:text-orange-300 focus:border-orange-300 dark:focus:border-orange-700 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
