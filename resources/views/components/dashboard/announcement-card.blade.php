@props([
    'title' => '',
    'date' => '',
    'priority' => 'default',
])

@php
    $priorityVariants = [
        'high' => 'danger',
        'medium' => 'warning',
        'low' => 'default',
        'default' => 'neutral',
    ];
    $variant = $priorityVariants[$priority] ?? 'neutral';
@endphp

<div {{ $attributes->merge(['class' => 'flex items-start gap-4 p-4 bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-xl hover:shadow-soft transition-all duration-200']) }}>
    <div class="w-2 h-2 mt-2 rounded-full shrink-0 {{ $priority === 'high' ? 'bg-danger' : ($priority === 'medium' ? 'bg-warning' : 'bg-primary') }}"></div>
    <div class="flex-1 min-w-0">
        <div class="flex items-start justify-between gap-2">
            <h4 class="text-sm font-medium text-secondary dark:text-white">{{ $title }}</h4>
            <x-ui.badge :variant="$variant" class="shrink-0 capitalize">{{ $priority }}</x-ui.badge>
        </div>
        <p class="mt-1 text-xs text-secondary/40 dark:text-white/40">{{ $date }}</p>
        @if ($slot->isNotEmpty())
            <p class="mt-2 text-sm text-secondary/60 dark:text-white/60">{{ $slot }}</p>
        @endif
    </div>
</div>
