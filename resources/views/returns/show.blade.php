@extends('layouts.dashboard')

@include('returns.partials.sample-data')

@php
    $return = $returns[0];
    $condition = $conditionBadgeMap[$return['condition']];
@endphp

@section('breadcrumb')
    <x-dashboard.breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => url('/dashboard')],
        ['label' => 'Returns', 'href' => url('/returns')],
        ['label' => '#' . str_pad($return['id'], 4, '0', STR_PAD_LEFT), 'active' => true],
    ]" />
@endsection

@section('content')
    <div class="max-w-[1400px] mx-auto space-y-6">
        <x-shared.page-toolbar
            :title="'Return #' . str_pad($return['id'], 4, '0', STR_PAD_LEFT)"
            subtitle="{{ $return['member'] }} · {{ $return['book'] }}"
            back-url="{{ url('/returns') }}"
            back-label="Back to Returns"
        >
            <x-ui.badge :variant="$return['is_late'] ? 'danger' : 'success'">
                {{ $return['is_late'] ? $return['days_late'] . ' days late' : 'On time' }}
            </x-ui.badge>
            <x-ui.badge :variant="$condition['variant']">{{ $condition['label'] }}</x-ui.badge>
        </x-shared.page-toolbar>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Left: Summary --}}
            <div class="space-y-6">
                <div class="bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl p-6 shadow-soft">
                    <h3 class="text-sm font-semibold text-secondary dark:text-white mb-4">Return Summary</h3>
                    <dl class="space-y-3 text-sm">
                        @foreach ([
                            ['Return ID', '#' . str_pad($return['id'], 4, '0', STR_PAD_LEFT)],
                            ['Borrowing ID', '#' . str_pad($return['borrowing_id'], 4, '0', STR_PAD_LEFT)],
                            ['Borrow Date', $return['borrow_date']],
                            ['Due Date', $return['due_date']],
                            ['Return Date', $return['return_date']],
                            ['Processed By', $return['processed_by']],
                        ] as [$label, $value])
                            <div class="flex justify-between gap-4">
                                <dt class="text-secondary/50 dark:text-white/50 shrink-0">{{ $label }}</dt>
                                <dd class="font-medium text-secondary dark:text-white text-right">{{ $value }}</dd>
                            </div>
                        @endforeach
                    </dl>
                </div>

                {{-- Fine Information --}}
                <div class="bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl p-6 shadow-soft">
                    <h3 class="text-sm font-semibold text-secondary dark:text-white mb-4">Fine Information</h3>
                    @if ($return['fine_amount'] > 0)
                        <div class="p-4 {{ $return['fine_paid'] ? 'bg-success/5 border-success/20' : 'bg-danger/5 border-danger/20' }} border rounded-xl mb-4">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-secondary/60 dark:text-white/60">Total Fine</span>
                                <span class="text-2xl font-bold {{ $return['fine_paid'] ? 'text-success' : 'text-danger' }}">
                                    ${{ number_format($return['fine_amount'], 2) }}
                                </span>
                            </div>
                            <div class="mt-3 flex items-center gap-2">
                                @if ($return['fine_paid'])
                                    <x-ui.badge variant="success">
                                        <x-ui.icon name="check-circle" class="w-3 h-3" />
                                        Paid
                                    </x-ui.badge>
                                @else
                                    <x-ui.badge variant="danger">
                                        <x-ui.icon name="exclamation-circle" class="w-3 h-3" />
                                        Unpaid
                                    </x-ui.badge>
                                @endif
                            </div>
                        </div>
                        @if ($return['is_late'])
                            <dl class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <dt class="text-secondary/50 dark:text-white/50">Late fee</dt>
                                    <dd class="text-secondary dark:text-white">${{ number_format($return['days_late'] * 2, 2) }}</dd>
                                </div>
                                @if ($return['condition'] === 'damaged')
                                    <div class="flex justify-between">
                                        <dt class="text-secondary/50 dark:text-white/50">Damage fee</dt>
                                        <dd class="text-secondary dark:text-white">${{ number_format($return['fine_amount'] - ($return['days_late'] * 2), 2) }}</dd>
                                    </div>
                                @endif
                            </dl>
                        @endif
                    @else
                        <div class="flex items-center gap-3 p-4 bg-success/5 border border-success/20 rounded-xl">
                            <x-ui.icon name="check-circle" class="w-5 h-5 text-success shrink-0" />
                            <p class="text-sm text-success font-medium">No fines applicable for this return.</p>
                        </div>
                    @endif
                </div>

                {{-- Condition --}}
                <div class="bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl p-6 shadow-soft">
                    <h3 class="text-sm font-semibold text-secondary dark:text-white mb-4">Book Condition</h3>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-11 h-11 rounded-xl flex items-center justify-center {{ $return['condition'] === 'damaged' ? 'bg-danger/10 text-danger' : 'bg-success/10 text-success' }}">
                            <x-ui.icon :name="$return['condition'] === 'damaged' ? 'exclamation-triangle' : 'check-circle'" class="w-5 h-5" />
                        </div>
                        <div>
                            <x-ui.badge :variant="$condition['variant']" class="!text-sm">{{ $condition['label'] }}</x-ui.badge>
                            <p class="text-xs text-secondary/50 dark:text-white/50 mt-1">Assessed at return</p>
                        </div>
                    </div>
                    @if ($return['notes'])
                        <p class="text-sm text-secondary/70 dark:text-white/70">{{ $return['notes'] }}</p>
                    @endif
                </div>
            </div>

            {{-- Right: Details + Timeline --}}
            <div class="lg:col-span-2 space-y-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl p-5 shadow-soft">
                        <p class="text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider mb-2">Member</p>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-primary/10 dark:bg-primary/20 rounded-lg flex items-center justify-center text-sm font-semibold text-primary">
                                {{ collect(explode(' ', $return['member']))->map(fn($w) => $w[0])->join('') }}
                            </div>
                            <div>
                                <p class="font-medium text-secondary dark:text-white">{{ $return['member'] }}</p>
                                <p class="text-xs text-secondary/50 dark:text-white/50">ID: {{ $return['member_id'] }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl p-5 shadow-soft">
                        <p class="text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider mb-2">Book</p>
                        <a href="{{ url('/books/' . $return['book_id']) }}" class="font-medium text-secondary dark:text-white hover:text-primary transition-colors">
                            {{ $return['book'] }}
                        </a>
                        <p class="text-xs font-mono text-secondary/40 dark:text-white/40 mt-1">{{ $return['isbn'] }}</p>
                    </div>
                </div>

                <div class="bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-2xl p-6 shadow-soft">
                    <h3 class="text-sm font-semibold text-secondary dark:text-white mb-4">Loan Period</h3>
                    <div class="flex items-center gap-4">
                        <div class="flex-1 text-center p-4 bg-background dark:bg-white/5 rounded-xl">
                            <p class="text-xs text-secondary/50 dark:text-white/50 mb-1">Borrowed</p>
                            <p class="text-sm font-semibold text-secondary dark:text-white">{{ $return['borrow_date'] }}</p>
                        </div>
                        <x-ui.icon name="arrow-right" class="w-5 h-5 text-secondary/30 shrink-0" />
                        <div class="flex-1 text-center p-4 bg-background dark:bg-white/5 rounded-xl">
                            <p class="text-xs text-secondary/50 dark:text-white/50 mb-1">Due</p>
                            <p class="text-sm font-semibold text-secondary dark:text-white">{{ $return['due_date'] }}</p>
                        </div>
                        <x-ui.icon name="arrow-right" class="w-5 h-5 text-secondary/30 shrink-0" />
                        <div class="flex-1 text-center p-4 {{ $return['is_late'] ? 'bg-danger/5 border border-danger/20' : 'bg-success/5 border border-success/20' }} rounded-xl">
                            <p class="text-xs text-secondary/50 dark:text-white/50 mb-1">Returned</p>
                            <p class="text-sm font-semibold {{ $return['is_late'] ? 'text-danger' : 'text-success' }}">{{ $return['return_date'] }}</p>
                        </div>
                    </div>
                </div>

                <x-dashboard.timeline title="Return Timeline">
                    @foreach ($returnTimeline as $event)
                        <x-dashboard.timeline-item
                            :icon="$event['icon']"
                            :title="$event['title']"
                            :description="$event['description']"
                            :time="$event['time']"
                            :color="$event['color']"
                        />
                    @endforeach
                </x-dashboard.timeline>

                <div class="flex items-center gap-3">
                    <x-ui.button variant="outline" :href="url('/borrowings/' . $return['borrowing_id'])">
                        <x-ui.icon name="arrow-right-circle" class="w-4 h-4" />
                        View Borrowing
                    </x-ui.button>
                    @unless ($return['fine_paid'])
                        <x-ui.button variant="primary" type="button">
                            <x-ui.icon name="document-chart-bar" class="w-4 h-4" />
                            Collect Fine
                        </x-ui.button>
                    @endunless
                </div>
            </div>
        </div>
    </div>
@endsection
