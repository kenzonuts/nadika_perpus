@extends('layouts.dashboard')

@section('breadcrumb')
    <x-dashboard.breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => url('/dashboard')],
        ['label' => 'Profile', 'href' => url('/profile')],
        ['label' => 'Activity', 'active' => true],
    ]" />
@endsection

@section('content')
    <div class="max-w-[1000px] mx-auto space-y-6">
        <x-profile.tabs active="activity" />

        <x-shared.page-toolbar title="Activity" subtitle="Your recent actions and active login sessions." />

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <x-shared.form-section title="Recent Activity">
                <x-dashboard.timeline title="">
                    <x-dashboard.timeline-item icon="arrow-right-circle" title="Book borrowed" description="Borrowed Clean Code — due Jul 15, 2026" time="2 hours ago" color="primary" />
                    <x-dashboard.timeline-item icon="pencil-square" title="Profile updated" description="Changed phone number and bio" time="1 day ago" color="success" />
                    <x-dashboard.timeline-item icon="key" title="Password changed" description="Account password was updated successfully" time="3 days ago" color="warning" />
                    <x-dashboard.timeline-item icon="user-circle" title="Logged in" description="Signed in from Chrome on macOS" time="5 days ago" color="primary" />
                    <x-dashboard.timeline-item icon="document-chart-bar" title="Report exported" description="Exported borrowing report as PDF" time="1 week ago" color="success" />
                </x-dashboard.timeline>
            </x-shared.form-section>

            <x-shared.form-section title="Active Sessions" description="Devices currently signed in to your account.">
                <div class="space-y-3">
                    @foreach ([
                        ['device' => 'Chrome 126', 'os' => 'macOS Sonoma', 'ip' => '192.168.1.42', 'location' => 'Jakarta, ID', 'current' => true, 'last' => 'Active now'],
                        ['device' => 'Safari 17', 'os' => 'iOS 17.5', 'ip' => '10.0.0.18', 'location' => 'Jakarta, ID', 'current' => false, 'last' => '2 days ago'],
                        ['device' => 'Firefox 128', 'os' => 'Windows 11', 'ip' => '203.45.67.89', 'location' => 'Bandung, ID', 'current' => false, 'last' => '5 days ago'],
                    ] as $session)
                        <div class="p-4 bg-background dark:bg-white/5 rounded-xl border border-border dark:border-white/10">
                            <div class="flex items-start justify-between gap-3">
                                <div class="flex items-start gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-primary/10 dark:bg-primary/20 flex items-center justify-center shrink-0">
                                        <x-ui.icon :name="str_contains($session['os'], 'iOS') ? 'device-phone-mobile' : 'computer-desktop'" class="w-5 h-5 text-primary" />
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <p class="text-sm font-semibold text-secondary dark:text-white">{{ $session['device'] }}</p>
                                            @if ($session['current'])
                                                <x-ui.badge variant="success">Current</x-ui.badge>
                                            @endif
                                        </div>
                                        <p class="mt-0.5 text-xs text-secondary/50 dark:text-white/50">{{ $session['os'] }}</p>
                                        <p class="mt-1 text-xs font-mono text-secondary/40 dark:text-white/40">{{ $session['ip'] }} · {{ $session['location'] }}</p>
                                    </div>
                                </div>
                                <span class="text-xs text-secondary/40 dark:text-white/40 shrink-0">{{ $session['last'] }}</span>
                            </div>
                            @unless ($session['current'])
                                <div class="mt-3 pt-3 border-t border-border dark:border-white/10 flex justify-end">
                                    <x-ui.button variant="outline" size="sm" type="button" class="!text-danger !border-danger/30">
                                        Revoke Session
                                    </x-ui.button>
                                </div>
                            @endunless
                        </div>
                    @endforeach
                </div>

                <div class="mt-4 pt-4 border-t border-border dark:border-white/10">
                    <x-ui.button variant="outline" type="button" class="!text-danger !border-danger/30 w-full sm:w-auto">
                        <x-ui.icon name="arrow-right-on-rectangle" class="w-4 h-4" />
                        Sign Out All Other Sessions
                    </x-ui.button>
                </div>
            </x-shared.form-section>
        </div>
    </div>
@endsection
