@props([
    'title' => '',
    'description' => '',
    'icon' => 'plus',
    'color' => 'primary',
    'href' => '#',
])

@php
    $colorClasses = [
        'primary' => 'bg-primary/10 text-primary group-hover:bg-primary group-hover:text-white',
        'success' => 'bg-success/10 text-success group-hover:bg-success group-hover:text-white',
        'warning' => 'bg-warning/10 text-warning group-hover:bg-warning group-hover:text-white',
        'danger' => 'bg-danger/10 text-danger group-hover:bg-danger group-hover:text-white',
    ];
    $iconBg = $colorClasses[$color] ?? $colorClasses['primary'];
@endphp

<a
    href="{{ $href }}"
    {{ $attributes->merge(['class' => 'group flex flex-col items-center text-center p-5 bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl shadow-soft hover:shadow-soft-lg hover:-translate-y-1 hover:scale-[1.02] transition-all duration-300']) }}
>
    <div class="w-12 h-12 rounded-xl flex items-center justify-center transition-all duration-300 {{ $iconBg }}">
        <x-ui.icon :name="$icon" class="w-6 h-6" />
    </div>
    <h3 class="mt-3 text-sm font-semibold text-secondary dark:text-white">{{ $title }}</h3>
    <p class="mt-1 text-xs text-secondary/50 dark:text-white/50 leading-relaxed">{{ $description }}</p>
</a>
