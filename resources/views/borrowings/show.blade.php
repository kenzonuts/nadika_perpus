@extends('layouts.dashboard')


@php $borrowing = $borrowings[0]; $badge = $statusBadgeMap[$borrowing['status']]; @endphp

@section('breadcrumb')
    <x-dashboard.breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => url('/dashboard')],
        ['label' => 'Borrowings', 'href' => url('/borrowings')],
        ['label' => '#' . str_pad($borrowing['id'], 4, '0', STR_PAD_LEFT), 'active' => true],
    ]" />
@endsection

@section('content')
    <div class="max-w-[1400px] mx-auto space-y-6">
        <x-shared.page-toolbar
            :title="'Borrowing #' . str_pad($borrowing['id'], 4, '0', STR_PAD_LEFT)"
            subtitle="{{ $borrowing['member'] }} · {{ $borrowing['book'] }}"
            back-url="{{ url('/borrowings') }}"
            back-label="Back to Borrowings"
        >
            <x-ui.badge :variant="$badge['variant']" class="!text-sm">{{ $badge['label'] }}</x-ui.badge>
            @if ($borrowing['status'] === 'active')
                <x-ui.button variant="primary" size="sm" href="{{ url('/returns') }}">
                    <x-ui.icon name="arrow-left-circle" class="w-4 h-4" />
                    Process Return
                </x-ui.button>
            @endif
        </x-shared.page-toolbar>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Left: Details --}}
            <div class="space-y-6">
                {{-- Due Date Highlight --}}
                <div class="bg-card dark:bg-secondary/50 border rounded-2xl p-6 shadow-soft {{ $borrowing['status'] === 'overdue' ? 'border-danger/30 bg-danger/5 dark:bg-danger/10' : 'border-border dark:border-white/10' }}">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-11 h-11 rounded-xl flex items-center justify-center {{ $borrowing['status'] === 'overdue' ? 'bg-danger/10 text-danger' : 'bg-warning/10 text-warning' }}">
                            <x-ui.icon name="clock" class="w-5 h-5" />
                        </div>
                        <div>
                            <p class="text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">Due Date</p>
                            <p class="text-xl font-bold {{ $borrowing['status'] === 'overdue' ? 'text-danger' : 'text-secondary dark:text-white' }}">
                                {{ $borrowing['due_date'] }}
                            </p>
                        </div>
                    </div>
                    @if ($borrowing['status'] === 'overdue')
                        <div class="flex items-center gap-2 px-3 py-2 bg-danger/10 rounded-lg">
                            <x-ui.icon name="exclamation-triangle" class="w-4 h-4 text-danger shrink-0" />
                            <p class="text-sm text-danger font-medium">This borrowing is overdue. Please process return or send reminder.</p>
                        </div>
                    @elseif ($borrowing['status'] === 'active')
                        <p class="text-sm text-secondary/60 dark:text-white/60">5 days remaining until due date.</p>
                    @else
                        <p class="text-sm text-success">Returned on {{ $borrowing['returned_date'] }}</p>
                    @endif
                </div>

                <div class="bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl p-6 shadow-soft">
                    <h3 class="text-sm font-semibold text-secondary dark:text-white mb-4">Borrowing Details</h3>
                    <dl class="space-y-3 text-sm">
                        @foreach ([
                            ['Borrowing ID', '#' . str_pad($borrowing['id'], 4, '0', STR_PAD_LEFT)],
                            ['Status', $badge['label']],
                            ['Borrow Date', $borrowing['borrow_date']],
                            ['Due Date', $borrowing['due_date']],
                            ['Returned Date', $borrowing['returned_date'] ?? '—'],
                            ['ISBN', $borrowing['isbn']],
                        ] as [$label, $value])
                            <div class="flex justify-between gap-4">
                                <dt class="text-secondary/50 dark:text-white/50 shrink-0">{{ $label }}</dt>
                                <dd class="font-medium text-secondary dark:text-white text-right {{ $label === 'ISBN' ? 'font-mono text-xs' : '' }}">{{ $value }}</dd>
                            </div>
                        @endforeach
                    </dl>
                </div>

                <div class="bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl p-6 shadow-soft">
                    <h3 class="text-sm font-semibold text-secondary dark:text-white mb-4">Member</h3>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 bg-primary/10 dark:bg-primary/20 rounded-xl flex items-center justify-center text-sm font-semibold text-primary">
                            {{ collect(explode(' ', $borrowing['member']))->map(fn($w) => $w[0])->join('') }}
                        </div>
                        <div>
                            <p class="font-medium text-secondary dark:text-white">{{ $borrowing['member'] }}</p>
                            <p class="text-xs text-secondary/50 dark:text-white/50">Member ID: {{ $borrowing['member_id'] }}</p>
                        </div>
                    </div>
                    <x-ui.button variant="outline" size="sm" href="#" class="w-full justify-center">
                        View Member Profile
                    </x-ui.button>
                </div>
            </div>

            {{-- Right: Book + Timeline --}}
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl p-6 shadow-soft">
                    <h3 class="text-sm font-semibold text-secondary dark:text-white mb-4">Book Information</h3>
                    <div class="flex items-start gap-4">
                        <div class="w-16 h-22 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center shrink-0 shadow-soft">
                            <x-ui.icon name="book-open" class="w-6 h-6 text-white/80" />
                        </div>
                        <div class="flex-1 min-w-0">
                            <a href="{{ url('/books/' . $borrowing['book_id']) }}" class="text-lg font-semibold text-secondary dark:text-white hover:text-primary transition-colors">
                                {{ $borrowing['book'] }}
                            </a>
                            <p class="text-sm text-secondary/50 dark:text-white/50 mt-1 font-mono">{{ $borrowing['isbn'] }}</p>
                            @if ($borrowing['notes'])
                                <p class="mt-3 text-sm text-secondary/70 dark:text-white/70">{{ $borrowing['notes'] }}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <x-dashboard.timeline title="Borrowing Timeline">
                    <x-dashboard.timeline-item
                        icon="arrow-right-circle"
                        title="Book borrowed"
                        :description="$borrowing['member'] . ' checked out ' . $borrowing['book']"
                        :time="$borrowing['borrow_date'] . ' · 10:30 AM'"
                        color="primary"
                    />
                    @foreach ($borrowingTimeline as $event)
                        <x-dashboard.timeline-item
                            :icon="$event['icon']"
                            :title="$event['title']"
                            :description="$event['description']"
                            :time="$event['time']"
                            :color="$event['color']"
                        />
                    @endforeach
                    @if ($borrowing['status'] === 'returned')
                        <x-dashboard.timeline-item
                            icon="arrow-left-circle"
                            title="Book returned"
                            :description="$borrowing['member'] . ' returned ' . $borrowing['book']"
                            :time="$borrowing['returned_date'] . ' · 2:15 PM'"
                            color="success"
                        />
                    @endif
                </x-dashboard.timeline>
            </div>
        </div>
    </div>
@endsection
