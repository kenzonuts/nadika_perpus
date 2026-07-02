@extends('layouts.dashboard')

@include('borrowings.partials.sample-data')

@section('breadcrumb')
    <x-dashboard.breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => url('/dashboard')],
        ['label' => 'Borrowings', 'active' => true],
    ]" />
@endsection

@section('content')
    <div class="max-w-[1600px] mx-auto space-y-6" x-data="{ searchQuery: '', statusFilter: '', showFilters: false }">
        <x-shared.page-toolbar
            title="Borrowings"
            subtitle="Track and manage all book borrowings."
        >
            <x-ui.button variant="outline" size="sm" href="{{ url('/borrowings/history') }}">
                <x-ui.icon name="clock" class="w-4 h-4" />
                History
            </x-ui.button>
            <x-ui.button variant="outline" size="sm" type="button">
                <x-ui.icon name="arrow-down-tray" class="w-4 h-4" />
                Export
            </x-ui.button>
            <x-ui.button variant="primary" size="sm" href="{{ url('/borrowings/create') }}">
                <x-ui.icon name="plus" class="w-4 h-4" />
                New Borrowing
            </x-ui.button>
        </x-shared.page-toolbar>

        {{-- Statistics --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <x-dashboard.stat-card title="Total Borrowings" value="1,247" icon="arrow-right-circle" color="primary" trend="12%" :trend-up="true" />
            <x-dashboard.stat-card title="Active Loans" value="892" icon="book-open" color="success" />
            <x-dashboard.stat-card title="Overdue" value="34" icon="exclamation-triangle" color="danger" trend="3" :trend-up="false" />
            <x-dashboard.stat-card title="Returned This Month" value="156" icon="arrow-left-circle" color="warning" trend="8%" :trend-up="true" />
        </div>

        {{-- Filters --}}
        <x-shared.filter-toolbar placeholder="Search by member, book, or ID...">
            <select
                x-model="statusFilter"
                class="px-3 py-2 text-sm bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl text-secondary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/20"
            >
                <option value="">All Status</option>
                @foreach ($borrowingStatuses as $status)
                    <option value="{{ $status }}">{{ ucfirst($status) }}</option>
                @endforeach
            </select>

            <select class="px-3 py-2 text-sm bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl text-secondary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/20">
                <option value="">All Dates</option>
                <option value="today">Borrowed Today</option>
                <option value="week">This Week</option>
                <option value="month">This Month</option>
            </select>

            <select class="px-3 py-2 text-sm bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl text-secondary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/20">
                <option value="newest">Newest First</option>
                <option value="oldest">Oldest First</option>
                <option value="due_soon">Due Soon</option>
                <option value="overdue">Overdue First</option>
            </select>
        </x-shared.filter-toolbar>

        {{-- Table --}}
        <div class="bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl shadow-soft overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-border dark:border-white/10 bg-background/50 dark:bg-white/5">
                            <th class="px-4 lg:px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">ID</th>
                            <th class="px-4 lg:px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">Member</th>
                            <th class="px-4 lg:px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider hidden md:table-cell">Book</th>
                            <th class="px-4 lg:px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider hidden sm:table-cell">Borrow Date</th>
                            <th class="px-4 lg:px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider hidden lg:table-cell">Due Date</th>
                            <th class="px-4 lg:px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">Status</th>
                            <th class="px-4 lg:px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider hidden xl:table-cell">Returned</th>
                            <th class="px-4 lg:px-6 py-3.5 text-right text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border dark:divide-white/10">
                        @foreach ($borrowings as $borrowing)
                            @php $badge = $statusBadgeMap[$borrowing['status']]; @endphp
                            <tr class="hover:bg-background/80 dark:hover:bg-white/5 transition-colors group">
                                <td class="px-4 lg:px-6 py-4 font-mono text-xs text-secondary/60 dark:text-white/60">
                                    #{{ str_pad($borrowing['id'], 4, '0', STR_PAD_LEFT) }}
                                </td>
                                <td class="px-4 lg:px-6 py-4">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-8 h-8 bg-primary/10 dark:bg-primary/20 rounded-lg flex items-center justify-center text-xs font-semibold text-primary shrink-0">
                                            {{ collect(explode(' ', $borrowing['member']))->map(fn($w) => $w[0])->join('') }}
                                        </div>
                                        <span class="font-medium text-secondary dark:text-white">{{ $borrowing['member'] }}</span>
                                    </div>
                                </td>
                                <td class="px-4 lg:px-6 py-4 hidden md:table-cell">
                                    <a href="{{ url('/books/' . $borrowing['book_id']) }}" class="font-medium text-secondary dark:text-white hover:text-primary transition-colors">
                                        {{ $borrowing['book'] }}
                                    </a>
                                    <p class="text-xs text-secondary/40 dark:text-white/40 mt-0.5 font-mono">{{ $borrowing['isbn'] }}</p>
                                </td>
                                <td class="px-4 lg:px-6 py-4 text-secondary/60 dark:text-white/60 hidden sm:table-cell">{{ $borrowing['borrow_date'] }}</td>
                                <td class="px-4 lg:px-6 py-4 hidden lg:table-cell">
                                    <span class="{{ $borrowing['status'] === 'overdue' ? 'text-danger font-medium' : 'text-secondary/60 dark:text-white/60' }}">
                                        {{ $borrowing['due_date'] }}
                                    </span>
                                </td>
                                <td class="px-4 lg:px-6 py-4">
                                    <x-ui.badge :variant="$badge['variant']">{{ $badge['label'] }}</x-ui.badge>
                                </td>
                                <td class="px-4 lg:px-6 py-4 text-secondary/50 dark:text-white/50 hidden xl:table-cell">
                                    {{ $borrowing['returned_date'] ?? '—' }}
                                </td>
                                <td class="px-4 lg:px-6 py-4 text-right">
                                    <x-ui.button variant="ghost" size="sm" :href="url('/borrowings/' . $borrowing['id'])">
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

        <x-books.pagination :current="1" :total="3" :total-items="24" />
    </div>
@endsection
