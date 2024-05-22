@props(['active'])

@php
    $classes = ($active ?? false)
                ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-[#89333F] dark:border-[#89333F] text-start text-base font-medium text-white dark:text-white bg-[#A52B43] dark:bg-[#A52B43] focus:outline-none focus:text-white dark:focus:text-white focus:bg-[#A52B43] dark:focus:bg-[#A52B43] focus:border-[#A52B43] dark:focus:border-[#89333F] transition duration-150 ease-in-out'
                : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-black dark:text-black hover:text-white dark:hover:text-white hover:bg-[#A52B43] dark:hover:bg-[#A52B43] hover:border-[#89333F] dark:hover:border-[#89333F] focus:outline-none focus:text-white dark:focus:text-white focus:bg-[#89333F] dark:focus:bg-[#A52B43] focus:border-[#89333F] dark:focus:border-[#89333F] transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
