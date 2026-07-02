@props(['active' => 'index'])

@php
    $tabs = [
        ['id' => 'index', 'label' => 'Overview', 'href' => url('/reports'), 'icon' => 'chart-pie'],
        ['id' => 'books', 'label' => 'Books', 'href' => url('/reports/books'), 'icon' => 'book-open'],
        ['id' => 'members', 'label' => 'Members', 'href' => url('/reports/members'), 'icon' => 'users'],
        ['id' => 'borrowings', 'label' => 'Borrowings', 'href' => url('/reports/borrowings'), 'icon' => 'arrow-right-circle'],
        ['id' => 'fines', 'label' => 'Fines', 'href' => url('/reports/fines'), 'icon' => 'exclamation-triangle'],
    ];
@endphp

<nav class="flex overflow-x-auto gap-1 p-1 bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl mb-6" aria-label="Reports tabs">
    @foreach ($tabs as $tab)
        <a
            href="{{ $tab['href'] }}"
            class="inline-flex items-center gap-2 px-4 py-2.5 text-sm font-medium rounded-lg whitespace-nowrap transition-colors {{ $active === $tab['id'] ? 'bg-card dark:bg-secondary text-primary shadow-soft' : 'text-secondary/60 dark:text-white/60 hover:text-secondary dark:hover:text-white' }}"
            @if ($active === $tab['id']) aria-current="page" @endif
        >
            <x-ui.icon :name="$tab['icon']" class="w-4 h-4" />
            {{ $tab['label'] }}
        </a>
    @endforeach
</nav>
