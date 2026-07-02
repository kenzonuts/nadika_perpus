@props(['book' => []])

<article {{ $attributes->merge(['class' => 'group bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl overflow-hidden shadow-soft hover:shadow-soft-lg hover:-translate-y-1 transition-all duration-300']) }}>
    <div class="relative p-4 pb-0">
        <x-books.book-cover :book="$book" size="xl" class="mx-auto max-w-[140px]" />

        <div class="absolute top-6 right-6 flex flex-col gap-1.5">
            <x-books.book-badge type="category" :label="$book['category'] ?? ''" />
            <x-books.book-badge
                :type="($book['available'] ?? 0) > 0 ? 'available' : 'unavailable'"
                :label="($book['available'] ?? 0) > 0 ? 'Available' : 'Out of Stock'"
            />
        </div>
    </div>

    <div class="p-5">
        <h3 class="text-sm font-semibold text-secondary dark:text-white line-clamp-1 group-hover:text-primary transition-colors">
            {{ $book['title'] ?? '' }}
        </h3>
        <p class="text-xs text-secondary/50 dark:text-white/50 mt-0.5">{{ $book['author'] ?? '' }}</p>

        <div class="flex items-center justify-between mt-3">
            <div class="flex items-center gap-1">
                <x-ui.icon name="star" class="w-3.5 h-3.5 text-warning" />
                <span class="text-xs font-medium text-secondary dark:text-white">{{ $book['rating'] ?? '—' }}</span>
            </div>
            <span class="text-xs text-secondary/40 dark:text-white/40">{{ $book['borrows'] ?? 0 }} borrows</span>
        </div>

        <div class="flex items-center justify-between mt-3 pt-3 border-t border-border dark:border-white/10">
            <div class="text-xs">
                <span class="text-secondary/50 dark:text-white/50">Stock: </span>
                <span class="font-medium text-secondary dark:text-white">{{ $book['stock'] ?? 0 }}</span>
                <span class="text-secondary/30 dark:text-white/30 mx-1">·</span>
                <span class="font-medium text-success">{{ $book['available'] ?? 0 }} avail.</span>
            </div>
        </div>

        <div class="flex gap-2 mt-4">
            <x-ui.button variant="outline" size="sm" :href="url('/books/' . ($book['id'] ?? 1))" class="flex-1">
                <x-ui.icon name="eye" class="w-3.5 h-3.5" />
                View
            </x-ui.button>
            <x-ui.button variant="primary" size="sm" :href="url('/books/' . ($book['id'] ?? 1) . '/edit')" class="flex-1">
                <x-ui.icon name="pencil-square" class="w-3.5 h-3.5" />
                Edit
            </x-ui.button>
        </div>
    </div>
</article>
