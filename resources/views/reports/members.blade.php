@extends('layouts.dashboard')

@include('reports.partials.sample-data')

@section('breadcrumb')
    <x-dashboard.breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => url('/dashboard')],
        ['label' => 'Reports', 'href' => url('/reports')],
        ['label' => 'Members', 'active' => true],
    ]" />
@endsection

@section('content')
    <div class="max-w-[1600px] mx-auto space-y-6" x-data="{ searchQuery: '', status: 'all' }">
        <x-reports.tabs active="members" />

        <x-shared.page-toolbar title="Member Reports" subtitle="Engagement metrics, borrowing behavior, and membership trends.">
            <x-ui.button variant="outline" size="sm" type="button">
                <x-ui.icon name="arrow-down-tray" class="w-4 h-4" />
                Export
            </x-ui.button>
        </x-shared.page-toolbar>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <x-dashboard.stat-card title="Total Members" value="3,456" icon="users" trend="8.2%" :trend-up="true" color="primary" />
            <x-dashboard.stat-card title="New This Month" value="142" icon="user-plus" trend="15.3%" :trend-up="true" color="success" />
            <x-dashboard.stat-card title="Active Borrowers" value="1,892" icon="arrow-right-circle" color="warning" />
            <x-dashboard.stat-card title="Suspended" value="12" icon="no-symbol" color="danger" />
        </div>

        <x-shared.filter-toolbar placeholder="Search members...">
            <select x-model="status" class="px-3 py-2.5 text-sm bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl text-secondary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/20">
                <option value="all">All Status</option>
                <option value="active">Active</option>
                <option value="restricted">Restricted</option>
                <option value="suspended">Suspended</option>
            </select>
        </x-shared.filter-toolbar>

        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">
            <x-dashboard.chart-placeholder title="Member Registrations" subtitle="New sign-ups over time" />
            <x-dashboard.chart-placeholder title="Borrowing Activity" subtitle="Active vs inactive members" />
        </div>

        <x-dashboard.table title="Top Members by Activity">
            <thead>
                <tr class="border-b border-border dark:border-white/10">
                    <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">Member</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider hidden md:table-cell">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">Borrows</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider hidden sm:table-cell">Fines</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">Status</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border dark:divide-white/10">
                @foreach ($memberReports as $member)
                    <tr class="hover:bg-background dark:hover:bg-white/5 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 bg-primary/10 dark:bg-primary/20 rounded-lg flex items-center justify-center text-xs font-semibold text-primary shrink-0">
                                    {{ collect(explode(' ', $member['name']))->map(fn($w) => $w[0])->join('') }}
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-secondary dark:text-white">{{ $member['name'] }}</p>
                                    <p class="text-xs text-secondary/40 dark:text-white/40 md:hidden">{{ $member['email'] }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-secondary/60 dark:text-white/60 hidden md:table-cell">{{ $member['email'] }}</td>
                        <td class="px-6 py-4 text-sm font-medium text-secondary dark:text-white">{{ $member['borrows'] }}</td>
                        <td class="px-6 py-4 text-sm text-secondary/60 dark:text-white/60 hidden sm:table-cell">{{ $member['fines'] }}</td>
                        <td class="px-6 py-4">
                            <x-ui.badge :variant="$member['variant']">{{ $member['status'] }}</x-ui.badge>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-dashboard.table>
    </div>
@endsection
