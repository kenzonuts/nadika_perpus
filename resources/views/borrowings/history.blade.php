@extends('layouts.dashboard')

@include('borrowings.partials.sample-data')

@section('breadcrumb')
    <x-dashboard.breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => url('/dashboard')],
        ['label' => 'Borrowings', 'href' => url('/borrowings')],
        ['label' => 'History', 'active' => true],
    ]" />
@endsection

@section('content')
    <div class="max-w-[1600px] mx-auto space-y-6" x-data="{ searchQuery: '', statusFilter: '' }">
        <x-shared.page-toolbar
            title="Borrowing History"
            subtitle="Complete record of all borrowing transactions."
            back-url="{{ url('/borrowings') }}"
            back-label="Back to Borrowings"
        >
            <x-ui.button variant="outline" size="sm" type="button">
                <x-ui.icon name="arrow-down-tray" class="w-4 h-4" />
                Export
            </x-ui.button>
        </x-shared.page-toolbar>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <x-dashboard.stat-card title="Total Records" value="1,247" icon="clock" color="primary" />
            <x-dashboard.stat-card title="Completed" value="1,081" icon="check-circle" color="success" />
            <x-dashboard.stat-card title="Active" value="132" icon="arrow-right-circle" color="warning" />
            <x-dashboard.stat-card title="Overdue" value="34" icon="exclamation-triangle" color="danger" />
        </div>

        <x-shared.filter-toolbar placeholder="Search history by member, book, or ID...">
            <select
                x-model="statusFilter"
                class="px-3 py-2 text-sm bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl text-secondary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/20"
            >
                <option value="">All Status</option>
                @foreach ($borrowingStatuses as $status)
                    <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                @endforeach
            </select>

            <input
                type="date"
                class="px-3 py-2 text-sm bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl text-secondary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/20"
                placeholder="From date"
            />

            <input
                type="date"
                class="px-3 py-2 text-sm bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl text-secondary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/20"
                placeholder="To date"
            />
        </x-shared.filter-toolbar>

        <div class="bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl shadow-soft overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-border dark:border-white/10 bg-background/50 dark:bg-white/5">
                            <th class="px-4 lg:px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">ID</th>
                            <th class="px-4 lg:px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">Member</th>
                            <th class="px-4 lg:px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">Book</th>
                            <th class="px-4 lg:px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider hidden sm:table-cell">Borrow Date</th>
                            <th class="px-4 lg:px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider hidden md:table-cell">Due Date</th>
                            <th class="px-4 lg:px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">Status</th>
                            <th class="px-4 lg:px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider hidden lg:table-cell">Returned Date</th>
                            <th class="px-4 lg:px-6 py-3.5 text-right text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border dark:divide-white/10">
                        @foreach ($borrowingHistory as $record)
                            @php $badge = $statusBadgeMap[$record['status']]; @endphp
                            <tr class="hover:bg-background/80 dark:hover:bg-white/5 transition-colors">
                                <td class="px-4 lg:px-6 py-4 font-mono text-xs text-secondary/60 dark:text-white/60">
                                    #{{ str_pad($record['id'], 4, '0', STR_PAD_LEFT) }}
                                </td>
                                <td class="px-4 lg:px-6 py-4 font-medium text-secondary dark:text-white">{{ $record['member'] }}</td>
                                <td class="px-4 lg:px-6 py-4 text-secondary/60 dark:text-white/60">{{ $record['book'] }}</td>
                                <td class="px-4 lg:px-6 py-4 text-secondary/60 dark:text-white/60 hidden sm:table-cell">{{ $record['borrow_date'] }}</td>
                                <td class="px-4 lg:px-6 py-4 hidden md:table-cell">
                                    <span class="{{ $record['status'] === 'overdue' ? 'text-danger font-medium' : 'text-secondary/60 dark:text-white/60' }}">
                                        {{ $record['due_date'] }}
                                    </span>
                                </td>
                                <td class="px-4 lg:px-6 py-4">
                                    <x-ui.badge :variant="$badge['variant']">{{ $badge['label'] }}</x-ui.badge>
                                </td>
                                <td class="px-4 lg:px-6 py-4 text-secondary/50 dark:text-white/50 hidden lg:table-cell">
                                    {{ $record['returned_date'] ?? '—' }}
                                </td>
                                <td class="px-4 lg:px-6 py-4 text-right">
                                    <x-ui.button variant="ghost" size="sm" :href="url('/borrowings/' . $record['id'])">
                                        <x-ui.icon name="eye" class="w-4 h-4" />
                                        View
                                    </x-ui.button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <x-books.pagination :current="1" :total="5" :total-items="120" :per-page="12" />
    </div>
@endsection
