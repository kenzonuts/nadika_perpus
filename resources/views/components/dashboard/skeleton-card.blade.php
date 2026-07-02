<div {{ $attributes->merge(['class' => 'bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl p-5 space-y-4']) }} aria-hidden="true">
    <div class="flex items-center justify-between">
        <x-dashboard.skeleton variant="circle" class="w-11 h-11" />
        <x-dashboard.skeleton class="w-16 h-6 rounded-full" />
    </div>
    <x-dashboard.skeleton variant="title" class="w-24" />
    <x-dashboard.skeleton variant="text" />
    <div class="flex items-end gap-1 h-8">
        @for ($i = 0; $i < 7; $i++)
            <x-dashboard.skeleton class="flex-1 h-full rounded-sm" />
        @endfor
    </div>
</div>
