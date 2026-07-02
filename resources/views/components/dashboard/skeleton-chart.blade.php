<div {{ $attributes->merge(['class' => 'bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl p-6 space-y-4']) }} aria-hidden="true">
    <div class="space-y-2">
        <x-dashboard.skeleton variant="title" class="w-48" />
        <x-dashboard.skeleton variant="text" class="w-64" />
    </div>
    <x-dashboard.skeleton variant="chart" />
</div>
