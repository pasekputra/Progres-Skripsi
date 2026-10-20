@props(['href' => '#', 'variant' => 'primary', 'size' => 'md'])

@php
    $dasar = 'inline-flex items-center justify-center gap-2 border font-semibold transition';

    $ukuran = [
        'md' => 'rounded-xl px-6 py-3.5 text-sm',
        'sm' => 'rounded-[10px] px-4 py-[9px] text-[13px]',
    ][$size] ?? 'rounded-xl px-6 py-3.5 text-sm';

    $varian = [
        'primary' => 'border-transparent bg-brand text-ink shadow-[0_6px_16px_rgba(245,130,32,.28)] hover:bg-brand-hover',
        'outline' => 'border-line bg-white text-ink hover:border-brand',
    ][$variant] ?? '';
@endphp

<a href="{{ $href }}" {{ $attributes->merge(['class' => "$dasar $ukuran $varian"]) }}>{{ $slot }}</a>