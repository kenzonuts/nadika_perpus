<div {{ $attributes->merge(['class' => 'bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl overflow-hidden']) }} aria-hidden="true">
    <div class="px-6 py-4 border-b border-border dark:border-white/10">
        <x-dashboard.skeleton variant="title" class="w-40" />
    </div>
    <div class="divide-y divide-border dark:divide-white/10">
        @for ($i = 0; $i < ($rows ?? 4); $i++)
            <div class="px-6 py-4 flex items-center gap-4">
                <x-dashboard.skeleton variant="circle" class="w-9 h-9" />
                <x-dashboard.skeleton class="flex-1" />
                <x-dashboard.skeleton class="w-20 hidden sm:block" />
                <x-dashboard.skeleton class="w-16 h-6 rounded-full" />
            </div>
        @endfor
    </div>
</div>
