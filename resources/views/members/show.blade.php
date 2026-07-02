@extends('layouts.dashboard')


@php
    $member = $members[0];
    $statusConfig = [
        'active' => ['label' => 'Active', 'variant' => 'success', 'description' => 'Member has full borrowing access.'],
        'inactive' => ['label' => 'Inactive', 'variant' => 'neutral', 'description' => 'Membership is inactive. Renewal required.'],
        'suspended' => ['label' => 'Suspended', 'variant' => 'danger', 'description' => 'Account suspended. Contact library admin.'],
        'expired' => ['label' => 'Expired', 'variant' => 'warning', 'description' => 'Membership has expired.'],
    ];
    $statusItem = $statusConfig[$member['status']] ?? $statusConfig['active'];
@endphp

@section('breadcrumb')
    <x-dashboard.breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => url('/dashboard')],
        ['label' => 'Members', 'href' => url('/members')],
        ['label' => $member['name'], 'active' => true],
    ]" />
@endsection

@section('content')
    <div class="max-w-[1400px] mx-auto space-y-6">
        <x-shared.page-toolbar :title="$member['name']" subtitle="Member profile and borrowing history.">
            <x-ui.button variant="outline" size="sm" href="{{ url('/members') }}">
                <x-ui.icon name="arrow-left" class="w-4 h-4" />
                Back
            </x-ui.button>
            <x-ui.button variant="outline" size="sm" type="button">
                <x-ui.icon name="qr-code" class="w-4 h-4" />
                Print QR Card
            </x-ui.button>
            <x-ui.button variant="primary" size="sm" :href="url('/members/' . $member['id'] . '/edit')">
                <x-ui.icon name="pencil-square" class="w-4 h-4" />
                Edit
            </x-ui.button>
        </x-shared.page-toolbar>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Left column: Profile + QR Card --}}
            <div class="space-y-6">
                {{-- Profile card --}}
                <x-shared.form-section>
                    <div class="text-center">
                        <div class="w-24 h-24 mx-auto rounded-2xl bg-gradient-to-br {{ $member['color'] }} flex items-center justify-center text-white text-2xl font-bold shadow-soft mb-4">
                            {{ $member['avatar_initials'] }}
                        </div>
                        <h2 class="text-xl font-bold text-secondary dark:text-white">{{ $member['name'] }}</h2>
                        <p class="mt-1 text-sm text-secondary/60 dark:text-white/60">{{ $member['email'] }}</p>
                        <div class="flex items-center justify-center gap-2 mt-3">
                            <x-ui.badge variant="default">{{ $member['membership_type'] }}</x-ui.badge>
                            <x-ui.badge :variant="$statusItem['variant']">{{ $statusItem['label'] }}</x-ui.badge>
                        </div>
                    </div>

                    <dl class="mt-6 pt-6 border-t border-border dark:border-white/10 space-y-3 text-sm">
                        @foreach ([
                            ['Phone', $member['phone']],
                            ['Joined', $member['join_date']],
                            ['Currently Borrowing', $member['borrowed_count'] . ' books'],
                            ['Member ID', $member['qr_code']],
                        ] as [$label, $value])
                            <div class="flex justify-between gap-4">
                                <dt class="text-secondary/50 dark:text-white/50 shrink-0">{{ $label }}</dt>
                                <dd class="font-medium text-secondary dark:text-white text-right {{ $label === 'Member ID' ? 'font-mono text-xs' : '' }}">{{ $value }}</dd>
                            </div>
                        @endforeach
                    </dl>
                </x-shared.form-section>

                {{-- QR Member Card --}}
                <x-shared.form-section title="Member Card">
                    <div class="relative bg-gradient-to-br from-primary to-primary-dark rounded-2xl p-6 text-white overflow-hidden">
                        <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full -translate-y-1/2 translate-x-1/2"></div>
                        <div class="absolute bottom-0 left-0 w-24 h-24 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/2"></div>

                        <div class="relative z-10">
                            <div class="flex items-center justify-between mb-6">
                                <div>
                                    <p class="text-xs text-white/70 uppercase tracking-wider">Smart Library</p>
                                    <p class="text-sm font-semibold mt-0.5">Member Card</p>
                                </div>
                                <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center text-sm font-bold">
                                    {{ $member['avatar_initials'] }}
                                </div>
                            </div>

                            <p class="text-lg font-bold">{{ $member['name'] }}</p>
                            <p class="text-sm text-white/70 mt-0.5">{{ $member['membership_type'] }} Member</p>

                            <div class="mt-6 flex items-end justify-between gap-4">
                                <div>
                                    <p class="text-xs text-white/50">Member ID</p>
                                    <p class="text-sm font-mono font-medium">{{ $member['qr_code'] }}</p>
                                </div>
                                <div class="w-20 h-20 bg-white rounded-xl flex items-center justify-center shrink-0">
                                    <div class="w-16 h-16 relative">
                                        <div class="absolute inset-0 grid grid-cols-4 grid-rows-4 gap-px">
                                            @foreach ([1,0,1,1, 0,1,0,1, 1,0,1,0, 1,1,0,1] as $cell)
                                                <div class="{{ $cell ? 'bg-secondary' : 'bg-transparent' }}"></div>
                                            @endforeach
                                        </div>
                                        <x-ui.icon name="qr-code" class="w-16 h-16 text-secondary absolute inset-0" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex gap-2 mt-4">
                        <x-ui.button variant="outline" size="sm" type="button" class="flex-1">
                            <x-ui.icon name="arrow-down-tray" class="w-4 h-4" />
                            Download
                        </x-ui.button>
                        <x-ui.button variant="outline" size="sm" type="button" class="flex-1">
                            <x-ui.icon name="document-duplicate" class="w-4 h-4" />
                            Print
                        </x-ui.button>
                    </div>
                </x-shared.form-section>

                {{-- Membership Status --}}
                <x-shared.form-section title="Membership Status">
                    <div class="flex items-start gap-4">
                        <div class="w-11 h-11 rounded-xl flex items-center justify-center shrink-0
                            {{ $statusItem['variant'] === 'success' ? 'bg-success/10 text-success' : '' }}
                            {{ $statusItem['variant'] === 'danger' ? 'bg-danger/10 text-danger' : '' }}
                            {{ $statusItem['variant'] === 'warning' ? 'bg-warning/10 text-warning' : '' }}
                            {{ $statusItem['variant'] === 'neutral' ? 'bg-background dark:bg-white/5 text-secondary/60 dark:text-white/60' : '' }}
                        ">
                            <x-ui.icon
                                :name="$member['status'] === 'active' ? 'check-circle' : ($member['status'] === 'suspended' ? 'x-circle' : 'clock')"
                                class="w-5 h-5"
                            />
                        </div>
                        <div>
                            <div class="flex items-center gap-2">
                                <p class="text-sm font-semibold text-secondary dark:text-white">{{ $statusItem['label'] }}</p>
                                <x-ui.badge :variant="$statusItem['variant']">{{ $member['membership_type'] }}</x-ui.badge>
                            </div>
                            <p class="mt-1 text-sm text-secondary/50 dark:text-white/50">{{ $statusItem['description'] }}</p>
                            <p class="mt-2 text-xs text-secondary/40 dark:text-white/40">Member since {{ $member['join_date'] }}</p>
                        </div>
                    </div>

                    @if ($member['borrowed_count'] > 0)
                        <div class="mt-4 p-3 bg-warning/10 border border-warning/20 rounded-xl">
                            <div class="flex items-center gap-2 text-sm text-warning">
                                <x-ui.icon name="book-open" class="w-4 h-4 shrink-0" />
                                <span>Currently borrowing <strong>{{ $member['borrowed_count'] }}</strong> {{ Str::plural('book', $member['borrowed_count']) }}</span>
                            </div>
                        </div>
                    @endif
                </x-shared.form-section>
            </div>

            {{-- Right column: Details + History --}}
            <div class="lg:col-span-2 space-y-6">
                <x-shared.form-section title="Contact & Notes">
                    <dl class="space-y-3 text-sm">
                        <div class="flex justify-between gap-4">
                            <dt class="text-secondary/50 dark:text-white/50 shrink-0">Address</dt>
                            <dd class="font-medium text-secondary dark:text-white text-right">{{ $member['address'] }}</dd>
                        </div>
                        <div class="flex justify-between gap-4">
                            <dt class="text-secondary/50 dark:text-white/50 shrink-0">Email</dt>
                            <dd class="font-medium text-secondary dark:text-white text-right">{{ $member['email'] }}</dd>
                        </div>
                        <div class="flex justify-between gap-4">
                            <dt class="text-secondary/50 dark:text-white/50 shrink-0">Phone</dt>
                            <dd class="font-medium text-secondary dark:text-white text-right">{{ $member['phone'] }}</dd>
                        </div>
                    </dl>
                    @if (!empty($member['notes']))
                        <div class="mt-4 pt-4 border-t border-border dark:border-white/10">
                            <p class="text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider mb-2">Notes</p>
                            <p class="text-sm text-secondary/70 dark:text-white/70 leading-relaxed">{{ $member['notes'] }}</p>
                        </div>
                    @endif
                </x-shared.form-section>

                <x-dashboard.timeline title="Borrow History">
                    @foreach ($borrowHistory as $item)
                        @php
                            $icon = match ($item['action']) {
                                'Borrowed' => 'arrow-right-circle',
                                'Returned' => 'arrow-left-circle',
                                'Overdue' => 'exclamation-triangle',
                                default => 'book-open',
                            };
                        @endphp
                        <x-dashboard.timeline-item
                            :icon="$icon"
                            :title="$item['book']"
                            :description="$item['action'] . ($item['due_date'] && in_array($item['action'], ['Borrowed', 'Overdue']) ? ' · Due ' . $item['due_date'] : '')"
                            :time="$item['date']"
                            :color="$item['color']"
                        />
                    @endforeach
                </x-dashboard.timeline>

                <x-dashboard.timeline title="Activity Timeline">
                    <x-dashboard.timeline-item icon="plus-circle" title="Member registered" :description="'Joined as ' . $member['membership_type'] . ' member'" :time="$member['join_date']" color="primary" />
                    <x-dashboard.timeline-item icon="pencil-square" title="Profile updated" description="Contact information was updated" time="Jun 15, 2026" color="warning" />
                    <x-dashboard.timeline-item icon="arrow-right-circle" title="Book borrowed" description="Borrowed Clean Code" time="Jul 1, 2026" color="success" />
                </x-dashboard.timeline>
            </div>
        </div>
    </div>
@endsection
