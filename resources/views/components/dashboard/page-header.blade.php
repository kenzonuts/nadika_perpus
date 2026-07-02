@props([
    'title' => null,
    'subtitle' => null,
])

<div {{ $attributes->merge(['class' => 'mb-6 lg:mb-8 animate-fade-up']) }}>
    @if ($title)
        <h1 class="text-2xl lg:text-3xl font-bold text-secondary dark:text-white tracking-tight">{{ $title }}</h1>
    @endif
    @if ($subtitle)
        <p class="mt-1 text-sm text-secondary/60 dark:text-white/60">{{ $subtitle }}</p>
    @endif
    @if ($slot->isNotEmpty())
        <div class="mt-4">{{ $slot }}</div>
    @endif
</div>
