@props(['variant' => 'outline'])

@php
    $baseStyles = "px-6 py-2 rounded-md font-medium transition-all border-1 border-[#6B4F3B] bg-[#6B4F3B]";

    $variants = [
        'outline' => 'border-[#6B4F3B] text-[#6B4F3B] bg-white hover:bg-[#6B4F3B] hover:text-white cursor-pointer',
        'solid' => 'border-[#6B4F3B] bg-[#6B4F3B] text-white hover:bg-[#4A3729] cursor-pointer'
    ];

    $classes = $baseStyles . '' . ($variants[$variant] ?? $variants['outline']);
@endphp

<button {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</button>