@props([
    'title' => 'No data yet',
    'description' => 'Get started by creating your first item.',
    'icon' => 'inbox',
    'action' => null,
    'actionHref' => '#',
])

<div {{ $attributes->merge(['class' => 'flex flex-col items-center justify-center text-center py-12 px-6']) }}>
    <div class="w-16 h-16 bg-background dark:bg-white/5 rounded-2xl flex items-center justify-center mb-4">
        <x-ui.icon :name="$icon" class="w-8 h-8 text-secondary/30 dark:text-white/30" />
    </div>
    <h3 class="text-base font-semibold text-secondary dark:text-white">{{ $title }}</h3>
    <p class="mt-2 text-sm text-secondary/50 dark:text-white/50 max-w-sm">{{ $description }}</p>
    @if ($action)
        <x-ui.button variant="primary" size="sm" :href="$actionHref" class="mt-6">{{ $action }}</x-ui.button>
    @endif
</div>
