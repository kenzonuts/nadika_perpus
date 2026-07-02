@extends('layouts.dashboard')

@include('reports.partials.sample-data')

@section('breadcrumb')
    <x-dashboard.breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => url('/dashboard')],
        ['label' => 'Reports', 'href' => url('/reports')],
        ['label' => 'Fines', 'active' => true],
    ]" />
@endsection

@section('content')
    <div class="max-w-[1600px] mx-auto space-y-6" x-data="{ searchQuery: '', status: 'all' }">
        <x-reports.tabs active="fines" />

        <x-shared.page-toolbar title="Fine Reports" subtitle="Outstanding fines, payment history, and collection analytics.">
            <x-ui.button variant="outline" size="sm" type="button">
                <x-ui.icon name="arrow-down-tray" class="w-4 h-4" />
                Export
            </x-ui.button>
        </x-shared.page-toolbar>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <x-dashboard.stat-card title="Total Collected" value="Rp 18.5M" icon="document-chart-bar" trend="22.1%" :trend-up="true" color="success" />
            <x-dashboard.stat-card title="Outstanding" value="Rp 2.4M" icon="exclamation-triangle" color="danger" />
            <x-dashboard.stat-card title="Avg. Fine Amount" value="Rp 32,500" icon="chart-bar" color="warning" />
            <x-dashboard.stat-card title="Waived This Month" value="Rp 450K" icon="check-circle" color="primary" />
        </div>

        <x-shared.filter-toolbar placeholder="Search fines...">
            <select x-model="status" class="px-3 py-2.5 text-sm bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl text-secondary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/20">
                <option value="all">All Status</option>
                <option value="unpaid">Unpaid</option>
                <option value="paid">Paid</option>
                <option value="waived">Waived</option>
            </select>
        </x-shared.filter-toolbar>

        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
            <x-dashboard.chart-placeholder title="Fine Collection" subtitle="Monthly revenue from fines" />
            <x-dashboard.chart-placeholder title="Payment Status" subtitle="Paid vs unpaid vs waived breakdown" />
        </div>

        <x-dashboard.table title="Fine Records">
            <thead>
                <tr class="border-b border-border dark:border-white/10">
                    <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">Member</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider hidden sm:table-cell">Book</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">Amount</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider hidden md:table-cell">Days Late</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider hidden lg:table-cell">Issued</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border dark:divide-white/10">
                @foreach ($fineReports as $fine)
                    <tr class="hover:bg-background dark:hover:bg-white/5 transition-colors">
                        <td class="px-6 py-4 text-sm font-medium text-secondary dark:text-white">{{ $fine['member'] }}</td>
                        <td class="px-6 py-4 text-sm text-secondary/60 dark:text-white/60 hidden sm:table-cell">{{ $fine['book'] }}</td>
                        <td class="px-6 py-4 text-sm font-semibold text-secondary dark:text-white">{{ $fine['amount'] }}</td>
                        <td class="px-6 py-4 text-sm text-secondary/60 dark:text-white/60 hidden md:table-cell">{{ $fine['days'] }} days</td>
                        <td class="px-6 py-4 text-sm text-secondary/50 dark:text-white/50 hidden lg:table-cell">{{ $fine['issued'] }}</td>
                        <td class="px-6 py-4">
                            <x-ui.badge :variant="$fine['variant']">{{ $fine['status'] }}</x-ui.badge>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-dashboard.table>
    </div>
@endsection
