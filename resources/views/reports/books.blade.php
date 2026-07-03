@extends('layouts.dashboard')


@section('breadcrumb')
    <x-dashboard.breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => url('/dashboard')],
        ['label' => 'Reports', 'href' => url('/reports')],
        ['label' => 'Books', 'active' => true],
    ]" />
@endsection

@section('content')
    <div class="max-w-[1600px] mx-auto space-y-6" x-data="{ searchQuery: '', category: 'all' }">
        <x-reports.tabs active="books" />

        <x-shared.page-toolbar title="Book Reports" subtitle="Catalog performance, circulation rates, and inventory insights.">
            <x-ui.button variant="outline" size="sm" type="button">
                <x-ui.icon name="arrow-down-tray" class="w-4 h-4" />
                Export
            </x-ui.button>
        </x-shared.page-toolbar>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach ($statCards as $stat)
                <x-dashboard.stat-card :title="$stat['title']" :value="$stat['value']" :icon="$stat['icon']" :color="$stat['color']" />
            @endforeach
        </div>

        <x-shared.filter-toolbar placeholder="Search books...">
            <select x-model="category" class="px-3 py-2.5 text-sm bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl text-secondary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/20">
                <option value="all">All Categories</option>
                <option value="programming">Programming</option>
                <option value="engineering">Engineering</option>
                <option value="self-help">Self-Help</option>
            </select>
            <select class="px-3 py-2.5 text-sm bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl text-secondary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/20">
                <option>Sort by Borrows</option>
                <option>Sort by Title</option>
                <option>Sort by Stock</option>
            </select>
        </x-shared.filter-toolbar>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
            <div class="xl:col-span-2">
                <x-dashboard.chart-placeholder title="Borrowing by Category" subtitle="Distribution across catalog sections" />
            </div>
            <x-dashboard.chart-placeholder title="Stock Levels" subtitle="Available vs borrowed copies" />
        </div>

        <x-dashboard.table title="Book Performance">
            <thead>
                <tr class="border-b border-border dark:border-white/10">
                    <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">Title</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider hidden sm:table-cell">Category</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">Borrows</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider hidden md:table-cell">Stock</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">Trend</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border dark:divide-white/10">
                @foreach ($bookReports as $book)
                    <tr class="hover:bg-background dark:hover:bg-white/5 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-lg bg-primary/10 dark:bg-primary/20 flex items-center justify-center shrink-0">
                                    <x-ui.icon name="book-open" class="w-4 h-4 text-primary" />
                                </div>
                                <span class="text-sm font-medium text-secondary dark:text-white">{{ $book['title'] }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-secondary/60 dark:text-white/60 hidden sm:table-cell">{{ $book['category'] }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-secondary dark:text-white">{{ $book['borrows'] }}</td>
                        <td class="px-6 py-4 text-sm text-secondary/60 dark:text-white/60 hidden md:table-cell">{{ $book['available'] }}/{{ $book['stock'] }}</td>
                        <td class="px-6 py-4">
                            <x-ui.badge :variant="$book['variant']">{{ $book['trend'] }}</x-ui.badge>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-dashboard.table>
    </div>
@endsection
