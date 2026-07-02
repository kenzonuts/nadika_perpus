<div {{ $attributes->merge(['class' => 'sticky top-24']) }}>
    <div class="bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl p-6 shadow-soft">
        <h3 class="text-sm font-semibold text-secondary dark:text-white mb-4">Live Preview</h3>

        <div class="flex flex-col items-center text-center">
            <template x-if="coverPreview">
                <img :src="coverPreview" class="w-full max-w-[180px] aspect-[3/4] object-cover rounded-xl shadow-soft-lg mb-4" alt="Preview" />
            </template>
            <template x-if="!coverPreview">
                <div class="w-full max-w-[180px] aspect-[3/4] bg-gradient-to-br from-primary to-primary-dark rounded-xl flex items-center justify-center shadow-soft-lg mb-4">
                    <x-ui.icon name="book-open" class="w-12 h-12 text-white/80" />
                </div>
            </template>

            <h4 class="text-lg font-bold text-secondary dark:text-white line-clamp-2" x-text="form.title || 'Book Title'"></h4>
            <p class="text-sm text-secondary/50 dark:text-white/50 mt-1" x-text="form.subtitle || 'Subtitle will appear here'"></p>

            <div class="flex flex-wrap justify-center gap-2 mt-3">
                <span x-show="form.category" class="inline-flex items-center px-2.5 py-0.5 text-xs font-medium rounded-full bg-primary/10 text-primary border border-primary/20" x-text="form.category"></span>
                <span class="inline-flex items-center px-2.5 py-0.5 text-xs font-medium rounded-full bg-success/10 text-success border border-success/20" x-text="(form.stock || 0) + ' in stock'"></span>
            </div>

            <dl class="w-full mt-6 space-y-3 text-left">
                <div class="flex justify-between text-sm">
                    <dt class="text-secondary/50 dark:text-white/50">Author</dt>
                    <dd class="font-medium text-secondary dark:text-white" x-text="form.author || '—'"></dd>
                </div>
                <div class="flex justify-between text-sm">
                    <dt class="text-secondary/50 dark:text-white/50">ISBN</dt>
                    <dd class="font-mono text-xs text-secondary dark:text-white" x-text="form.isbn || '—'"></dd>
                </div>
                <div class="flex justify-between text-sm">
                    <dt class="text-secondary/50 dark:text-white/50">Publisher</dt>
                    <dd class="font-medium text-secondary dark:text-white" x-text="form.publisher || '—'"></dd>
                </div>
                <div class="flex justify-between text-sm">
                    <dt class="text-secondary/50 dark:text-white/50">Year</dt>
                    <dd class="font-medium text-secondary dark:text-white" x-text="form.year || '—'"></dd>
                </div>
            </dl>

            <p class="mt-4 text-xs text-secondary/40 dark:text-white/40 line-clamp-3 text-left w-full" x-text="form.description || 'Description preview...'"></p>
        </div>
    </div>
</div>
