@props([
    'title' => '',
    'action' => null,
    'actionHref' => '#',
])

<div {{ $attributes->merge(['class' => 'bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl shadow-soft overflow-hidden']) }}>
    @if ($title)
        <div class="flex items-center justify-between px-6 py-4 border-b border-border dark:border-white/10">
            <h3 class="text-base font-semibold text-secondary dark:text-white">{{ $title }}</h3>
            @if ($action)
                <a href="{{ $actionHref }}" class="text-sm font-medium text-primary hover:text-primary-dark dark:hover:text-primary-light transition-colors">{{ $action }}</a>
            @endif
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-sm">
            {{ $slot }}
        </table>
    </div>
</div>
