<div {{ $attributes->merge(['class' => 'bg-gradient-to-br from-primary to-primary-dark rounded-2xl p-6 lg:p-8 text-white shadow-soft-lg relative overflow-hidden']) }}>
    <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/4"></div>

    <div class="relative z-10 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <p class="text-sm text-white/70">Welcome back,</p>
            <h2 class="text-2xl lg:text-3xl font-bold mt-1">Admin User 👋</h2>
            <p class="mt-2 text-sm text-white/70 max-w-md">Here's what's happening with your library today. You have <span class="font-semibold text-white">12 pending returns</span> and <span class="font-semibold text-white">3 new members</span> this week.</p>
        </div>

        <div class="flex gap-3 shrink-0">
            <x-ui.button variant="white" size="sm" href="#">
                <x-ui.icon name="plus" class="w-4 h-4" />
                Add Book
            </x-ui.button>
            <x-ui.button variant="white-outline" size="sm" href="#">
                View Reports
            </x-ui.button>
        </div>
    </div>
</div>
