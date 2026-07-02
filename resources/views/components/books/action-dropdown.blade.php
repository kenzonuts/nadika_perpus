@props(['bookId' => null])

@php
    $menuId = 'book-menu-' . ($bookId ?? uniqid());
@endphp

<div class="relative" @click.outside="closeRowMenu()">
    <button
        type="button"
        @click.stop="toggleRowMenu('{{ $menuId }}')"
        class="p-1.5 rounded-lg text-secondary/50 dark:text-white/50 hover:bg-background dark:hover:bg-white/5 hover:text-secondary dark:hover:text-white transition-colors focus:outline-none focus:ring-2 focus:ring-primary/20"
        aria-label="Book actions"
        :aria-expanded="activeRowMenu === '{{ $menuId }}'"
    >
        <x-ui.icon name="ellipsis-vertical" class="w-5 h-5" />
    </button>

    <div
        x-show="activeRowMenu === '{{ $menuId }}'"
        x-cloak
        x-transition
        class="absolute right-0 mt-1 w-48 bg-card dark:bg-secondary border border-border dark:border-white/10 rounded-xl shadow-soft-lg overflow-hidden z-50"
        role="menu"
    >
        <a href="{{ url('/books/' . $bookId) }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm text-secondary/70 dark:text-white/70 hover:bg-background dark:hover:bg-white/5" role="menuitem" @click="closeRowMenu()">
            <x-ui.icon name="eye" class="w-4 h-4" /> View
        </a>
        <a href="{{ url('/books/' . $bookId . '/edit') }}" class="flex items-center gap-2.5 px-4 py-2.5 text-sm text-secondary/70 dark:text-white/70 hover:bg-background dark:hover:bg-white/5" role="menuitem" @click="closeRowMenu()">
            <x-ui.icon name="pencil-square" class="w-4 h-4" /> Edit
        </a>
        <button type="button" class="w-full flex items-center gap-2.5 px-4 py-2.5 text-sm text-secondary/70 dark:text-white/70 hover:bg-background dark:hover:bg-white/5 text-left" role="menuitem" @click="closeRowMenu()">
            <x-ui.icon name="document-duplicate" class="w-4 h-4" /> Duplicate
        </button>
        <button type="button" class="w-full flex items-center gap-2.5 px-4 py-2.5 text-sm text-secondary/70 dark:text-white/70 hover:bg-background dark:hover:bg-white/5 text-left" role="menuitem" @click="closeRowMenu()">
            <x-ui.icon name="archive-box" class="w-4 h-4" /> Archive
        </button>
        <div class="border-t border-border dark:border-white/10">
            <button
                type="button"
                class="w-full flex items-center gap-2.5 px-4 py-2.5 text-sm text-danger hover:bg-danger/5 text-left"
                role="menuitem"
                @click="openDeleteModal({ id: {{ $bookId }}, title: '{{ addslashes($attributes->get('book-title', 'Book')) }}', author: '{{ addslashes($attributes->get('book-author', '')) }}', color: '{{ $attributes->get('book-color', 'from-primary to-primary-dark') }}' })"
            >
                <x-ui.icon name="trash" class="w-4 h-4" /> Delete
            </button>
        </div>
    </div>
</div>
