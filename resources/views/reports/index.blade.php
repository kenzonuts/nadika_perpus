@extends('layouts.dashboard')


@section('breadcrumb')
    <x-dashboard.breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => url('/dashboard')],
        ['label' => 'Reports', 'active' => true],
    ]" />
@endsection

@section('content')
    <div class="max-w-[1600px] mx-auto space-y-6" x-data="{ dateRange: '30d' }">
        <x-reports.tabs active="index" />

        <x-shared.page-toolbar title="Reports Overview" subtitle="Library performance metrics and analytics at a glance.">
            <x-ui.button variant="outline" size="sm" type="button">
                <x-ui.icon name="arrow-down-tray" class="w-4 h-4" />
                Export CSV
            </x-ui.button>
            <x-ui.button variant="outline" size="sm" type="button">
                <x-ui.icon name="document-chart-bar" class="w-4 h-4" />
                Export PDF
            </x-ui.button>
            <x-ui.button variant="primary" size="sm" type="button">
                <x-ui.icon name="arrow-path-rounded" class="w-4 h-4" />
                Refresh
            </x-ui.button>
        </x-shared.page-toolbar>

        {{-- Date filter --}}
        <div class="bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl p-4 shadow-soft">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="flex items-center gap-2">
                    <x-ui.icon name="clock" class="w-5 h-5 text-secondary/50 dark:text-white/50" />
                    <span class="text-sm font-medium text-secondary dark:text-white">Date Range</span>
                </div>
                <div class="flex flex-wrap items-center gap-2">
                    @foreach (['7d' => 'Last 7 days', '30d' => 'Last 30 days', '90d' => 'Last 90 days', '12m' => 'Last 12 months'] as $value => $label)
                        <button
                            type="button"
                            @click="dateRange = '{{ $value }}'"
                            :class="dateRange === '{{ $value }}' ? 'bg-primary text-white border-primary' : 'bg-background dark:bg-white/5 text-secondary/70 dark:text-white/70 border-border dark:border-white/10 hover:border-primary/30'"
                            class="px-4 py-2 text-sm font-medium border rounded-xl transition-colors"
                        >
                            {{ $label }}
                        </button>
                    @endforeach
                    <input
                        type="date"
                        class="px-3 py-2 text-sm bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl text-secondary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/20"
                        aria-label="Custom start date"
                    />
                    <span class="text-secondary/40 dark:text-white/40">—</span>
                    <input
                        type="date"
                        class="px-3 py-2 text-sm bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl text-secondary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/20"
                        aria-label="Custom end date"
                    />
                </div>
            </div>
        </div>

        {{-- Stat cards --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4 lg:gap-6">
            @foreach ($overviewStats as $stat)
                <x-dashboard.stat-card
                    :title="$stat['title']"
                    :value="$stat['value']"
                    :icon="$stat['icon']"
                    :trend="$stat['trend']"
                    :trend-up="$stat['trendUp']"
                    :color="$stat['color']"
                    class="animate-fade-up"
                />
            @endforeach
        </div>

        {{-- Charts --}}
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
            <x-dashboard.chart-placeholder title="Borrowing Trends" subtitle="Daily borrowings over selected period" />
            <x-dashboard.chart-placeholder title="Member Growth" subtitle="New registrations and active members" />
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
            <div class="xl:col-span-2">
                <x-dashboard.chart-placeholder title="Revenue & Fines" subtitle="Fine collection and payment trends" />
            </div>
            <x-dashboard.chart-placeholder title="Category Distribution" subtitle="Books borrowed by category" class="!p-4" />
        </div>

        {{-- Quick summary table --}}
        <x-dashboard.table title="Top Performing Books" action="View full report" :action-href="url('/reports/books')">
            <thead>
                <tr class="border-b border-border dark:border-white/10">
                    <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">Book</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider hidden sm:table-cell">Category</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">Borrows</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider hidden md:table-cell">Trend</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border dark:divide-white/10">
                @foreach (array_slice($bookReports, 0, 4) as $book)
                    <tr class="hover:bg-background dark:hover:bg-white/5 transition-colors">
                        <td class="px-6 py-4 text-sm font-medium text-secondary dark:text-white">{{ $book['title'] }}</td>
                        <td class="px-6 py-4 text-sm text-secondary/60 dark:text-white/60 hidden sm:table-cell">{{ $book['category'] }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-secondary dark:text-white">{{ $book['borrows'] }}</td>
                        <td class="px-6 py-4 hidden md:table-cell">
                            <x-ui.badge :variant="$book['variant']">{{ $book['trend'] }}</x-ui.badge>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-dashboard.table>
    </div>
@endsection
