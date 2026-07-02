@extends('layouts.dashboard')

@include('audit.partials.sample-data')

@section('breadcrumb')
    <x-dashboard.breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => url('/dashboard')],
        ['label' => 'Audit Log', 'active' => true],
    ]" />
@endsection

@section('content')
    <div class="max-w-[1600px] mx-auto space-y-6" x-data="{ searchQuery: '', severity: 'all', action: 'all' }">
        <x-shared.page-toolbar title="Audit Log" subtitle="Track all system activity, security events, and user actions.">
            <x-ui.button variant="outline" size="sm" type="button">
                <x-ui.icon name="arrow-down-tray" class="w-4 h-4" />
                Export Log
            </x-ui.button>
            <x-ui.button variant="outline" size="sm" type="button">
                <x-ui.icon name="arrow-path-rounded" class="w-4 h-4" />
                Refresh
            </x-ui.button>
        </x-shared.page-toolbar>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <x-dashboard.stat-card title="Total Events" value="10,842" icon="clipboard-document-list" color="primary" />
            <x-dashboard.stat-card title="Warnings" value="47" icon="exclamation-triangle" color="warning" />
            <x-dashboard.stat-card title="Critical" value="8" icon="shield-exclamation" color="danger" />
            <x-dashboard.stat-card title="Today's Events" value="156" icon="clock" trend="12%" :trend-up="true" color="success" />
        </div>

        <x-shared.filter-toolbar placeholder="Search by user, action, or IP...">
            <select x-model="severity" class="px-3 py-2.5 text-sm bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl text-secondary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/20">
                <option value="all">All Severity</option>
                <option value="info">Info</option>
                <option value="success">Success</option>
                <option value="warning">Warning</option>
                <option value="danger">Critical</option>
            </select>
            <select x-model="action" class="px-3 py-2.5 text-sm bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl text-secondary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/20">
                <option value="all">All Actions</option>
                <option value="auth">Authentication</option>
                <option value="borrowing">Borrowing</option>
                <option value="book">Books</option>
                <option value="settings">Settings</option>
            </select>
            <input type="date" class="px-3 py-2.5 text-sm bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl text-secondary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/20" aria-label="Filter by date" />
        </x-shared.filter-toolbar>

        <x-dashboard.table title="Activity Log">
            <thead>
                <tr class="border-b border-border dark:border-white/10">
                    <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">Severity</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">User</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider hidden md:table-cell">Action</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider hidden lg:table-cell">Description</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider hidden sm:table-cell">IP</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider hidden xl:table-cell">Device</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">Time</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider"></th>
                </tr>
            </thead>
            <tbody class="divide-y divide-border dark:divide-white/10">
                @foreach ($auditLogs as $log)
                    <tr class="hover:bg-background dark:hover:bg-white/5 transition-colors">
                        <td class="px-6 py-4">
                            <x-ui.badge :variant="$severityVariants[$log['severity']]">
                                {{ ucfirst($log['severity']) }}
                            </x-ui.badge>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2.5">
                                <div class="w-8 h-8 bg-primary/10 dark:bg-primary/20 rounded-lg flex items-center justify-center text-xs font-semibold text-primary shrink-0">
                                    {{ $log['user'] !== 'Unknown' && $log['user'] !== 'System' ? collect(explode(' ', $log['user']))->map(fn($w) => $w[0])->join('') : '—' }}
                                </div>
                                <div class="min-w-0">
                                    <p class="text-sm font-medium text-secondary dark:text-white truncate">{{ $log['user'] }}</p>
                                    <p class="text-xs text-secondary/40 dark:text-white/40 truncate md:hidden">{{ $log['action'] }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 hidden md:table-cell">
                            <code class="text-xs font-mono px-2 py-1 bg-background dark:bg-white/5 rounded-lg text-secondary/70 dark:text-white/70">{{ $log['action'] }}</code>
                        </td>
                        <td class="px-6 py-4 text-sm text-secondary/60 dark:text-white/60 hidden lg:table-cell max-w-xs truncate">{{ $log['description'] }}</td>
                        <td class="px-6 py-4 text-sm font-mono text-secondary/50 dark:text-white/50 hidden sm:table-cell">{{ $log['ip'] }}</td>
                        <td class="px-6 py-4 text-sm text-secondary/50 dark:text-white/50 hidden xl:table-cell">{{ $log['device'] }}</td>
                        <td class="px-6 py-4 text-sm text-secondary/50 dark:text-white/50 whitespace-nowrap">{{ $log['relative'] }}</td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ url('/audit/' . $log['id']) }}" class="inline-flex items-center gap-1 text-sm font-medium text-primary hover:text-primary-dark transition-colors">
                                View
                                <x-ui.icon name="chevron-right" class="w-4 h-4" />
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-dashboard.table>
    </div>
@endsection
