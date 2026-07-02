@props([
    'icon' => 'check-circle',
    'title' => '',
    'description' => '',
    'time' => '',
    'color' => 'primary',
])

@php
    $dotColors = [
        'primary' => 'bg-primary',
        'success' => 'bg-success',
        'warning' => 'bg-warning',
        'danger' => 'bg-danger',
    ];
    $dot = $dotColors[$color] ?? $dotColors['primary'];
@endphp

<div {{ $attributes->merge(['class' => 'relative flex gap-4 pb-6 last:pb-0']) }}>
    <div class="relative flex flex-col items-center">
        <div class="w-9 h-9 rounded-xl bg-card dark:bg-secondary border border-border dark:border-white/10 flex items-center justify-center shrink-0 z-10">
            <x-ui.icon :name="$icon" class="w-4 h-4 text-secondary/60 dark:text-white/60" />
        </div>
        <div class="absolute top-9 bottom-0 w-px bg-border dark:bg-white/10"></div>
    </div>

    <div class="flex-1 min-w-0 pt-1">
        <div class="flex items-start justify-between gap-2">
            <p class="text-sm font-medium text-secondary dark:text-white">{{ $title }}</p>
            <span class="text-xs text-secondary/40 dark:text-white/40 shrink-0">{{ $time }}</span>
        </div>
        <p class="mt-0.5 text-sm text-secondary/50 dark:text-white/50">{{ $description }}</p>
    </div>
</div>
