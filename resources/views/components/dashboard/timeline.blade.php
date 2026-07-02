@props(['title' => 'Recent Activity'])

<div {{ $attributes->merge(['class' => 'bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl p-6 shadow-soft']) }}>
    <h3 class="text-base font-semibold text-secondary dark:text-white mb-4">{{ $title }}</h3>
    <div class="space-y-0">
        {{ $slot }}
    </div>
</div>
