@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-[#962D3D] focus:ring-[#962D3D] focus:ring-#7C2935 rounded-md shadow-sm']) !!}>
