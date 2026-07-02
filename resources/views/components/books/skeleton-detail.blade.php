<div {{ $attributes->merge(['class' => 'bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl p-6 space-y-6']) }} aria-hidden="true">
    <div class="flex gap-6">
        <x-dashboard.skeleton variant="circle" class="w-48 h-64 rounded-2xl shrink-0" />
        <div class="flex-1 space-y-4">
            <x-dashboard.skeleton variant="title" class="w-2/3" />
            <x-dashboard.skeleton variant="text" class="w-1/2" />
            <div class="grid grid-cols-2 gap-4 pt-4">
                @for ($i = 0; $i < 6; $i++)
                    <x-dashboard.skeleton />
                @endfor
            </div>
        </div>
    </div>
</div>
