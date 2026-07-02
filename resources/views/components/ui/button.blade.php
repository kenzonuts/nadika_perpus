@props([
    'variant' => 'primary',
    'size' => 'md',
    'href' => null,
    'type' => 'button',
    'disabled' => false,
])

@php
    $baseClasses = 'inline-flex items-center justify-center font-medium rounded-xl transition-all duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2';

    $variants = [
        'primary' => 'bg-primary text-white hover:bg-primary-dark shadow-soft hover:shadow-soft-lg hover:-translate-y-0.5 focus:ring-primary',
        'secondary' => 'bg-secondary text-white hover:bg-secondary/90 shadow-soft hover:shadow-soft-lg hover:-translate-y-0.5 focus:ring-secondary',
        'outline' => 'border border-border bg-card text-secondary hover:bg-background hover:border-primary/30 focus:ring-primary',
        'ghost' => 'text-secondary hover:bg-background focus:ring-primary',
        'white' => 'bg-white text-primary hover:bg-white/90 shadow-soft hover:shadow-soft-lg hover:-translate-y-0.5 focus:ring-white',
        'white-outline' => 'border border-white/30 text-white hover:bg-white/10 focus:ring-white',
    ];

    $sizes = [
        'sm' => 'px-4 py-2 text-sm gap-1.5',
        'md' => 'px-6 py-3 text-sm gap-2',
        'lg' => 'px-8 py-3.5 text-base gap-2',
    ];

    $classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['primary']) . ' ' . ($sizes[$size] ?? $sizes['md']);
@endphp

@if ($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </a>
@else
    <button type="{{ $type }}" @disabled($disabled) {{ $attributes->merge(['class' => $classes]) }}>
        {{ $slot }}
    </button>
@endif
