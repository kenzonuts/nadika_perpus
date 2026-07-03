@extends('layouts.dashboard')


@section('breadcrumb')
    <x-dashboard.breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => url('/dashboard')],
        ['label' => 'Reports', 'href' => url('/reports')],
        ['label' => 'Borrowings', 'active' => true],
    ]" />
@endsection

@section('content')
    <div class="max-w-[1600px] mx-auto space-y-6" x-data="{ searchQuery: '', status: 'all' }">
        <x-reports.tabs active="borrowings" />

        <x-shared.page-toolbar title="Borrowing Reports" subtitle="Circulation history, overdue tracking, and return patterns.">
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

        <x-shared.filter-toolbar placeholder="Search borrowings...">
            <select x-model="status" class="px-3 py-2.5 text-sm bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl text-secondary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/20">
                <option value="all">All Status</option>
                <option value="active">Active</option>
                <option value="returned">Returned</option>
                <option value="overdue">Overdue</option>
            </select>
            <input type="date" class="px-3 py-2.5 text-sm bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl text-secondary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/20" aria-label="Filter by date" />
        </x-shared.filter-toolbar>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">
            <div class="xl:col-span-2">
                <x-dashboard.chart-placeholder title="Daily Borrowings" subtitle="Borrow and return volume over time" />
            </div>
            <x-dashboard.chart-placeholder title="Return Rate" subtitle="On-time vs late returns" />
        </div>

        <x-dashboard.table title="Recent Borrowings">
            <thead>
                <tr class="border-b border-border dark:border-white/10">
                    <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">Member</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider hidden sm:table-cell">Book</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider hidden lg:table-cell">Borrowed</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider hidden lg:table-cell">Due</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider hidden md:table-cell">Returned</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border dark:divide-white/10">
                @foreach ($borrowingReports as $row)
                    <tr class="hover:bg-background dark:hover:bg-white/5 transition-colors">
                        <td class="px-6 py-4 text-sm font-medium text-secondary dark:text-white">{{ $row['member'] }}</td>
                        <td class="px-6 py-4 text-sm text-secondary/60 dark:text-white/60 hidden sm:table-cell">{{ $row['book'] }}</td>
                        <td class="px-6 py-4 text-sm text-secondary/50 dark:text-white/50 hidden lg:table-cell">{{ $row['borrowed'] }}</td>
                        <td class="px-6 py-4 text-sm text-secondary/50 dark:text-white/50 hidden lg:table-cell">{{ $row['due'] }}</td>
                        <td class="px-6 py-4 text-sm text-secondary/50 dark:text-white/50 hidden md:table-cell">{{ $row['returned'] }}</td>
                        <td class="px-6 py-4">
                            <x-ui.badge :variant="$row['variant']">{{ $row['status'] }}</x-ui.badge>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-dashboard.table>
    </div>
@endsection
