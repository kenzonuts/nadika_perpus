@props([
    'categories' => [],
    'publishers' => [],
    'authors' => [],
])

<div {{ $attributes->merge(['class' => 'bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl p-4 shadow-soft']) }}>
    <div class="flex flex-col lg:flex-row lg:items-center gap-4">
        <div class="flex-1 min-w-0">
            <x-books.search-bar x-data="{ showSuggestions: false }" />
        </div>

        <button
            type="button"
            @click="showFilters = !showFilters"
            class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-medium text-secondary/70 dark:text-white/70 border border-border dark:border-white/10 rounded-xl hover:bg-background dark:hover:bg-white/5 transition-colors lg:hidden"
        >
            <x-ui.icon name="funnel" class="w-4 h-4" />
            Filters
        </button>
    </div>

    <div
        class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-7 gap-3 mt-4"
        :class="{ 'hidden lg:grid': !showFilters, 'grid': showFilters }"
    >
        <select class="px-3 py-2 text-sm bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl text-secondary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/20">
            <option value="">All Categories</option>
            @foreach ($categories as $cat)
                <option value="{{ $cat }}">{{ $cat }}</option>
            @endforeach
        </select>

        <select class="px-3 py-2 text-sm bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl text-secondary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/20">
            <option value="">All Authors</option>
            @foreach ($authors as $author)
                <option value="{{ $author }}">{{ $author }}</option>
            @endforeach
        </select>

        <select class="px-3 py-2 text-sm bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl text-secondary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/20">
            <option value="">All Publishers</option>
            @foreach ($publishers as $pub)
                <option value="{{ $pub }}">{{ $pub }}</option>
            @endforeach
        </select>

        <select class="px-3 py-2 text-sm bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl text-secondary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/20">
            <option value="">All Years</option>
            @for ($y = 2026; $y >= 1990; $y--)
                <option value="{{ $y }}">{{ $y }}</option>
            @endfor
        </select>

        <select class="px-3 py-2 text-sm bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl text-secondary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/20">
            <option value="">Availability</option>
            <option value="available">Available</option>
            <option value="unavailable">Out of Stock</option>
        </select>

        <select class="px-3 py-2 text-sm bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl text-secondary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/20">
            <option value="">All Status</option>
            <option value="published">Published</option>
            <option value="draft">Draft</option>
            <option value="archived">Archived</option>
        </select>

        <select class="px-3 py-2 text-sm bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl text-secondary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/20">
            <option value="newest">Newest First</option>
            <option value="oldest">Oldest First</option>
            <option value="title">Title A-Z</option>
            <option value="borrows">Most Borrowed</option>
        </select>
    </div>

    <div class="flex items-center justify-between mt-4 pt-4 border-t border-border dark:border-white/10">
        <p class="text-xs text-secondary/50 dark:text-white/50">8 books found</p>

        <div class="flex items-center gap-1 p-1 bg-background dark:bg-white/5 rounded-xl border border-border dark:border-white/10">
            <button
                type="button"
                @click="setViewMode('grid')"
                class="p-2 rounded-lg transition-colors"
                :class="viewMode === 'grid' ? 'bg-card dark:bg-secondary shadow-soft text-primary' : 'text-secondary/50 dark:text-white/50 hover:text-secondary'"
                aria-label="Grid view"
            >
                <x-ui.icon name="squares-2x2" class="w-4 h-4" />
            </button>
            <button
                type="button"
                @click="setViewMode('table')"
                class="p-2 rounded-lg transition-colors"
                :class="viewMode === 'table' ? 'bg-card dark:bg-secondary shadow-soft text-primary' : 'text-secondary/50 dark:text-white/50 hover:text-secondary'"
                aria-label="Table view"
            >
                <x-ui.icon name="table-cells" class="w-4 h-4" />
            </button>
        </div>
    </div>
</div>
