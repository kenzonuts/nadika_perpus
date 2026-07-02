@props([
    'variant' => 'line',
    'class' => '',
])

@php
    $base = 'animate-pulse bg-border/60 dark:bg-white/10 rounded';
    $variants = [
        'line' => 'h-4 w-full',
        'title' => 'h-6 w-3/4',
        'text' => 'h-3 w-1/2',
        'circle' => 'rounded-full',
        'card' => 'h-32 w-full rounded-2xl',
        'chart' => 'h-64 w-full rounded-2xl',
    ];
@endphp

<div {{ $attributes->merge(['class' => $base . ' ' . ($variants[$variant] ?? $variants['line']) . ' ' . $class]) }} aria-hidden="true"></div>
