@props([
    'variant' => 'default',
])

@php
    $variants = [
        'default' => 'bg-primary/10 text-primary border border-primary/20 dark:bg-primary/20 dark:border-primary/30',
        'success' => 'bg-success/10 text-success border border-success/20 dark:bg-success/20 dark:border-success/30',
        'warning' => 'bg-warning/10 text-warning border border-warning/20 dark:bg-warning/20 dark:border-warning/30',
        'danger' => 'bg-danger/10 text-danger border border-danger/20 dark:bg-danger/20 dark:border-danger/30',
        'neutral' => 'bg-background text-secondary border border-border dark:bg-white/5 dark:text-white/70 dark:border-white/10',
    ];

    $classes = 'inline-flex items-center gap-1.5 px-3 py-1 text-xs font-medium rounded-full ' . ($variants[$variant] ?? $variants['default']);
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</span>
