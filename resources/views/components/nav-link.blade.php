@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'inline-flex items-center px-2 pt-1 border-b-2 border-[#89333F] dark:border-[#89333F] text-base font-medium leading-5 text-black dark:text-black focus:outline-none focus:border-[#89333F] transition duration-150 ease-in-out ml-3'
                : 'inline-flex items-center px-2 pt-1 border-b-2 border-transparent text-base font-medium leading-5 text-black dark:text-black hover:text-gray-500 dark:hover:text-gray-500 hover:border-[#89333F] dark:hover:border-[#89333F] focus:outline-none focus:text-gray-500 dark:focus:text-gray-500 focus:border-[#89333F] dark:focus:border-[#89333F] transition duration-150 ease-in-out ml-3';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

