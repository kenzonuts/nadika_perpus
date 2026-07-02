@props(['title' => 'Confirm Action', 'message' => 'Are you sure you want to proceed?', 'confirmLabel' => 'Confirm', 'cancelLabel' => 'Cancel', 'danger' => false])

<div
    x-show="deleteModalOpen"
    x-cloak
    class="fixed inset-0 z-[100] flex items-center justify-center p-4"
    role="dialog"
    aria-modal="true"
>
    <div class="fixed inset-0 bg-secondary/50 dark:bg-black/60 backdrop-blur-sm" @click="deleteModalOpen = false"></div>
    <div x-show="deleteModalOpen" x-transition class="relative w-full max-w-md bg-card dark:bg-secondary border border-border dark:border-white/10 rounded-2xl shadow-soft-xl p-6">
        <h3 class="text-lg font-semibold text-secondary dark:text-white">{{ $title }}</h3>
        <p class="mt-2 text-sm text-secondary/60 dark:text-white/60">{{ $message }}</p>
        @if ($slot->isNotEmpty())
            <div class="mt-4">{{ $slot }}</div>
        @endif
        <div class="flex gap-3 mt-6">
            <x-ui.button variant="outline" class="flex-1" type="button" @click="deleteModalOpen = false">{{ $cancelLabel }}</x-ui.button>
            <x-ui.button variant="primary" class="flex-1 {{ $danger ? '!bg-danger hover:!bg-danger/90' : '' }}" type="button" @click="deleteModalOpen = false">{{ $confirmLabel }}</x-ui.button>
        </div>
    </div>
</div>
