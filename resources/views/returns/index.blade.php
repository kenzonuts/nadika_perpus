@extends('layouts.dashboard')

@include('returns.partials.sample-data')

@section('breadcrumb')
    <x-dashboard.breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => url('/dashboard')],
        ['label' => 'Returns', 'active' => true],
    ]" />
@endsection

@section('content')
    <div class="max-w-[1600px] mx-auto space-y-6" x-data="{ searchQuery: '', lateFilter: '', conditionFilter: '' }">
        <x-shared.page-toolbar
            title="Returns"
            subtitle="View and manage all book return transactions."
        >
            <x-ui.button variant="outline" size="sm" type="button">
                <x-ui.icon name="arrow-down-tray" class="w-4 h-4" />
                Export
            </x-ui.button>
            <x-ui.button variant="primary" size="sm" href="{{ url('/borrowings') }}">
                <x-ui.icon name="arrow-left-circle" class="w-4 h-4" />
                Process Return
            </x-ui.button>
        </x-shared.page-toolbar>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            <x-dashboard.stat-card title="Total Returns" value="1,081" icon="arrow-left-circle" color="primary" trend="8%" :trend-up="true" />
            <x-dashboard.stat-card title="On Time" value="1,024" icon="check-circle" color="success" />
            <x-dashboard.stat-card title="Late Returns" value="57" icon="clock" color="warning" />
            <x-dashboard.stat-card title="Unpaid Fines" value="$124.00" icon="document-chart-bar" color="danger" />
        </div>

        <x-shared.filter-toolbar placeholder="Search by member, book, or return ID...">
            <select
                x-model="lateFilter"
                class="px-3 py-2 text-sm bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl text-secondary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/20"
            >
                <option value="">All Returns</option>
                <option value="on_time">On Time</option>
                <option value="late">Late Only</option>
            </select>

            <select
                x-model="conditionFilter"
                class="px-3 py-2 text-sm bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl text-secondary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/20"
            >
                <option value="">All Conditions</option>
                @foreach ($conditionBadgeMap as $key => $cond)
                    <option value="{{ $key }}">{{ $cond['label'] }}</option>
                @endforeach
            </select>

            <select class="px-3 py-2 text-sm bg-background dark:bg-white/5 border border-border dark:border-white/10 rounded-xl text-secondary dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/20">
                <option value="newest">Newest First</option>
                <option value="oldest">Oldest First</option>
                <option value="fine_high">Highest Fine</option>
            </select>
        </x-shared.filter-toolbar>

        <div class="bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl shadow-soft overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-border dark:border-white/10 bg-background/50 dark:bg-white/5">
                            <th class="px-4 lg:px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">ID</th>
                            <th class="px-4 lg:px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">Member</th>
                            <th class="px-4 lg:px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider hidden md:table-cell">Book</th>
                            <th class="px-4 lg:px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider hidden sm:table-cell">Return Date</th>
                            <th class="px-4 lg:px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider hidden lg:table-cell">Due Date</th>
                            <th class="px-4 lg:px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">Late</th>
                            <th class="px-4 lg:px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">Condition</th>
                            <th class="px-4 lg:px-6 py-3.5 text-left text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider hidden xl:table-cell">Fine</th>
                            <th class="px-4 lg:px-6 py-3.5 text-right text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border dark:divide-white/10">
                        @foreach ($returns as $return)
                            @php $condition = $conditionBadgeMap[$return['condition']]; @endphp
                            <tr class="hover:bg-background/80 dark:hover:bg-white/5 transition-colors">
                                <td class="px-4 lg:px-6 py-4 font-mono text-xs text-secondary/60 dark:text-white/60">
                                    #{{ str_pad($return['id'], 4, '0', STR_PAD_LEFT) }}
                                </td>
                                <td class="px-4 lg:px-6 py-4">
                                    <div class="flex items-center gap-2.5">
                                        <div class="w-8 h-8 bg-primary/10 dark:bg-primary/20 rounded-lg flex items-center justify-center text-xs font-semibold text-primary shrink-0">
                                            {{ collect(explode(' ', $return['member']))->map(fn($w) => $w[0])->join('') }}
                                        </div>
                                        <span class="font-medium text-secondary dark:text-white">{{ $return['member'] }}</span>
                                    </div>
                                </td>
                                <td class="px-4 lg:px-6 py-4 text-secondary/60 dark:text-white/60 hidden md:table-cell">{{ $return['book'] }}</td>
                                <td class="px-4 lg:px-6 py-4 text-secondary/60 dark:text-white/60 hidden sm:table-cell">{{ $return['return_date'] }}</td>
                                <td class="px-4 lg:px-6 py-4 text-secondary/50 dark:text-white/50 hidden lg:table-cell">{{ $return['due_date'] }}</td>
                                <td class="px-4 lg:px-6 py-4">
                                    @if ($return['is_late'])
                                        <x-ui.badge variant="danger">
                                            {{ $return['days_late'] }} {{ Str::plural('day', $return['days_late']) }} late
                                        </x-ui.badge>
                                    @else
                                        <x-ui.badge variant="success">On time</x-ui.badge>
                                    @endif
                                </td>
                                <td class="px-4 lg:px-6 py-4">
                                    <x-ui.badge :variant="$condition['variant']">{{ $condition['label'] }}</x-ui.badge>
                                </td>
                                <td class="px-4 lg:px-6 py-4 hidden xl:table-cell">
                                    @if ($return['fine_amount'] > 0)
                                        <span class="font-medium {{ $return['fine_paid'] ? 'text-secondary dark:text-white' : 'text-danger' }}">
                                            ${{ number_format($return['fine_amount'], 2) }}
                                        </span>
                                        @unless ($return['fine_paid'])
                                            <x-ui.badge variant="warning" class="ml-1">Unpaid</x-ui.badge>
                                        @endunless
                                    @else
                                        <span class="text-secondary/40 dark:text-white/40">—</span>
                                    @endif
                                </td>
                                <td class="px-4 lg:px-6 py-4 text-right">
                                    <x-ui.button variant="ghost" size="sm" :href="url('/returns/' . $return['id'])">
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

        <x-books.pagination :current="1" :total="4" :total-items="32" />
    </div>
@endsection
