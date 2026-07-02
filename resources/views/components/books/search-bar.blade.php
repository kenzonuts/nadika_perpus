@props(['placeholder' => 'Search books by title, ISBN, author...'])

<div {{ $attributes->merge(['class' => 'relative']) }}>
    <div class="relative">
        <x-ui.icon name="magnifying-glass" class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-secondary/40 dark:text-white/40" />
        <input
            type="search"
            x-model="searchQuery"
            placeholder="{{ $placeholder }}"
            class="w-full pl-10 pr-4 py-2.5 text-sm bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-xl text-secondary dark:text-white placeholder:text-secondary/40 dark:placeholder:text-white/40 focus:outline-none focus:border-primary focus:ring-2 focus:ring-primary/20 transition-all duration-200"
            aria-label="Search books"
            @focus="showSuggestions = true"
            @blur="setTimeout(() => showSuggestions = false, 200)"
        />
    </div>

    <div
        x-show="showSuggestions && searchQuery.length > 0"
        x-cloak
        class="absolute top-full left-0 right-0 mt-2 bg-card dark:bg-secondary border border-border dark:border-white/10 rounded-xl shadow-soft-lg overflow-hidden z-50"
    >
        <p class="px-4 py-2 text-xs font-medium text-secondary/40 dark:text-white/40 uppercase tracking-wider">Suggestions</p>
        <template x-for="item in recentSearches.filter(s => s.toLowerCase().includes(searchQuery.toLowerCase()))" :key="item">
            <button type="button" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-left text-secondary/70 dark:text-white/70 hover:bg-background dark:hover:bg-white/5" @mousedown.prevent="searchQuery = item">
                <x-ui.icon name="magnifying-glass" class="w-4 h-4 text-secondary/30" />
                <span x-html="item.replace(new RegExp(searchQuery, 'gi'), m => '<mark class=\'bg-primary/20 text-primary rounded px-0.5\'>' + m + '</mark>')"></span>
            </button>
        </template>
    </div>
</div>
