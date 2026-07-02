@props([
    'variant' => 'default',
])

@php
    $variants = [
        'default' => 'bg-primary/10 text-primary border border-primary/20',
        'success' => 'bg-success/10 text-success border border-success/20',
        'warning' => 'bg-warning/10 text-warning border border-warning/20',
        'danger' => 'bg-danger/10 text-danger border border-danger/20',
        'neutral' => 'bg-background text-secondary border border-border',
    ];

    $classes = 'inline-flex items-center gap-1.5 px-3 py-1 text-xs font-medium rounded-full ' . ($variants[$variant] ?? $variants['default']);
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</span>
