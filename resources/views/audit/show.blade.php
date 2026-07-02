@extends('layouts.dashboard')

@include('audit.partials.sample-data')

@php $log = $auditLogs[0]; @endphp

@section('breadcrumb')
    <x-dashboard.breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => url('/dashboard')],
        ['label' => 'Audit Log', 'href' => url('/audit')],
        ['label' => 'Event #' . $log['id'], 'active' => true],
    ]" />
@endsection

@section('content')
    <div class="max-w-[1200px] mx-auto space-y-6">
        <x-shared.page-toolbar
            title="Audit Event #{{ $log['id'] }}"
            subtitle="{{ $log['description'] }}"
            :back-url="url('/audit')"
            back-label="Back to Audit Log"
        >
            <x-ui.badge :variant="$severityVariants[$log['severity']]">{{ ucfirst($log['severity']) }}</x-ui.badge>
            <x-ui.button variant="outline" size="sm" type="button">
                <x-ui.icon name="arrow-down-tray" class="w-4 h-4" />
                Export
            </x-ui.button>
        </x-shared.page-toolbar>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            {{-- Main timeline --}}
            <div class="lg:col-span-2 space-y-6">
                <x-shared.form-section title="Event Timeline" description="Chronological sequence of related actions.">
                    <x-dashboard.timeline title="">
                        <x-dashboard.timeline-item
                            icon="plus-circle"
                            title="Book created"
                            :description="'Created \"Atomic Habits\" in catalog — ISBN 978-0735211292'"
                            time="14:32:18"
                            color="primary"
                        />
                        <x-dashboard.timeline-item
                            icon="document-text"
                            title="Metadata saved"
                            description="Category: Self-Help, Shelf: C-03, Stock: 8 copies"
                            time="14:32:19"
                            color="success"
                        />
                        <x-dashboard.timeline-item
                            icon="bell"
                            title="Notification sent"
                            description="Catalog update notification sent to 12 subscribed members"
                            time="14:32:22"
                            color="primary"
                        />
                        <x-dashboard.timeline-item
                            icon="clipboard-document-check"
                            title="Audit log recorded"
                            description="Event #{{ $log['id'] }} logged successfully"
                            time="14:32:18"
                            color="success"
                        />
                    </x-dashboard.timeline>
                </x-shared.form-section>

                <x-shared.form-section title="Event Details">
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                        @foreach ([
                            ['Action', $log['action']],
                            ['User', $log['user']],
                            ['Email', $log['email']],
                            ['Timestamp', $log['timestamp']],
                            ['Description', $log['description']],
                        ] as [$label, $value])
                            <div class="p-4 bg-background dark:bg-white/5 rounded-xl border border-border dark:border-white/10">
                                <dt class="text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider mb-1">{{ $label }}</dt>
                                <dd class="font-medium text-secondary dark:text-white {{ $label === 'Action' ? 'font-mono text-xs' : '' }}">{{ $value }}</dd>
                            </div>
                        @endforeach
                    </dl>
                </x-shared.form-section>
            </div>

            {{-- Sidebar: device & network info --}}
            <div class="space-y-6">
                <x-shared.form-section title="Network Information">
                    <div class="space-y-4">
                        <div class="flex items-start gap-3 p-4 bg-background dark:bg-white/5 rounded-xl border border-border dark:border-white/10">
                            <div class="w-10 h-10 rounded-xl bg-primary/10 dark:bg-primary/20 flex items-center justify-center shrink-0">
                                <x-ui.icon name="globe-alt" class="w-5 h-5 text-primary" />
                            </div>
                            <div>
                                <p class="text-xs font-medium text-secondary/50 dark:text-white/50 uppercase tracking-wider">IP Address</p>
                                <p class="mt-1 text-sm font-mono font-medium text-secondary dark:text-white">{{ $log['ip'] }}</p>
                                <p class="mt-1 text-xs text-secondary/40 dark:text-white/40">Private network · Local subnet</p>
                            </div>
                        </div>
                    </div>
                </x-shared.form-section>

                <x-shared.form-section title="Browser & Device">
                    <div class="space-y-3">
                        <div class="flex items-center gap-3 p-3 bg-background dark:bg-white/5 rounded-xl">
                            <x-ui.icon name="computer-desktop" class="w-5 h-5 text-secondary/50 dark:text-white/50" />
                            <div>
                                <p class="text-xs text-secondary/50 dark:text-white/50">Browser</p>
                                <p class="text-sm font-medium text-secondary dark:text-white">{{ $log['browser'] }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 p-3 bg-background dark:bg-white/5 rounded-xl">
                            <x-ui.icon name="device-phone-mobile" class="w-5 h-5 text-secondary/50 dark:text-white/50" />
                            <div>
                                <p class="text-xs text-secondary/50 dark:text-white/50">Device</p>
                                <p class="text-sm font-medium text-secondary dark:text-white">{{ $log['device'] }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3 p-3 bg-background dark:bg-white/5 rounded-xl">
                            <x-ui.icon name="map-pin" class="w-5 h-5 text-secondary/50 dark:text-white/50" />
                            <div>
                                <p class="text-xs text-secondary/50 dark:text-white/50">Location</p>
                                <p class="text-sm font-medium text-secondary dark:text-white">Jakarta, Indonesia</p>
                            </div>
                        </div>
                    </div>
                </x-shared.form-section>

                <x-shared.form-section title="User Agent">
                    <code class="block text-xs font-mono p-3 bg-background dark:bg-white/5 rounded-xl text-secondary/60 dark:text-white/60 break-all leading-relaxed">
                        Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36
                    </code>
                </x-shared.form-section>
            </div>
        </div>
    </div>
@endsection
