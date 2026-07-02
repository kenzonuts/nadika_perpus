<div
    x-show="deleteModalOpen"
    x-cloak
    class="fixed inset-0 z-[100] flex items-center justify-center p-4"
    role="dialog"
    aria-modal="true"
    aria-labelledby="delete-modal-title"
>
    <div class="fixed inset-0 bg-secondary/50 dark:bg-black/60 backdrop-blur-sm" @click="closeDeleteModal()"></div>

    <div
        x-show="deleteModalOpen"
        x-transition
        class="relative w-full max-w-md bg-card dark:bg-secondary border border-border dark:border-white/10 rounded-2xl shadow-soft-xl p-6"
    >
        <div class="flex items-center gap-3 mb-4">
            <div class="w-10 h-10 bg-danger/10 rounded-xl flex items-center justify-center shrink-0">
                <x-ui.icon name="trash" class="w-5 h-5 text-danger" />
            </div>
            <div>
                <h3 id="delete-modal-title" class="text-lg font-semibold text-secondary dark:text-white">Delete Book</h3>
                <p class="text-sm text-secondary/50 dark:text-white/50">This action cannot be undone.</p>
            </div>
        </div>

        <template x-if="selectedBook">
            <div class="flex items-center gap-4 p-4 bg-background dark:bg-white/5 rounded-xl mb-4">
                <div class="w-12 h-12 rounded-xl bg-gradient-to-br shrink-0 flex items-center justify-center" :class="selectedBook.color || 'from-primary to-primary-dark'">
                    <x-ui.icon name="book-open" class="w-5 h-5 text-white" />
                </div>
                <div class="min-w-0">
                    <p class="text-sm font-medium text-secondary dark:text-white truncate" x-text="selectedBook.title"></p>
                    <p class="text-xs text-secondary/50 dark:text-white/50" x-text="selectedBook.author"></p>
                </div>
            </div>
        </template>

        <p class="text-sm text-secondary/60 dark:text-white/60 mb-6">
            Are you sure you want to delete this book? It will be moved to trash and can be restored later.
        </p>

        <div class="flex gap-3">
            <x-ui.button variant="outline" class="flex-1" @click="closeDeleteModal()">Cancel</x-ui.button>
            <x-ui.button variant="primary" class="flex-1 !bg-danger hover:!bg-danger/90" @click="closeDeleteModal()">Delete</x-ui.button>
        </div>
    </div>
</div>
