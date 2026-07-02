@extends('layouts.dashboard')

@section('breadcrumb')
    <x-dashboard.breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => url('/dashboard')],
        ['label' => 'Settings', 'href' => url('/settings/general')],
        ['label' => 'Notifications', 'active' => true],
    ]" />
@endsection

@section('content')
    <div class="max-w-[800px] mx-auto space-y-6">
        <x-settings.tabs active="notifications" />

        <x-shared.page-toolbar title="Notification Settings" subtitle="Configure email and SMS notification preferences.">
            <x-ui.button variant="primary" size="sm" type="button">
                <x-ui.icon name="check" class="w-4 h-4" />
                Save Changes
            </x-ui.button>
        </x-shared.page-toolbar>

        <x-shared.form-section title="Email Notifications" description="Choose which events trigger email alerts.">
            <div class="space-y-4">
                @foreach ([
                    ['name' => 'email_borrow_confirm', 'label' => 'Borrowing confirmation', 'desc' => 'Send email when a book is borrowed', 'checked' => true],
                    ['name' => 'email_return_reminder', 'label' => 'Return reminders', 'desc' => 'Remind members 2 days before due date', 'checked' => true],
                    ['name' => 'email_overdue_notice', 'label' => 'Overdue notices', 'desc' => 'Notify when books become overdue', 'checked' => true],
                    ['name' => 'email_fine_issued', 'label' => 'Fine issued', 'desc' => 'Alert when a fine is applied', 'checked' => true],
                    ['name' => 'email_new_member', 'label' => 'New member welcome', 'desc' => 'Welcome email for new registrations', 'checked' => true],
                    ['name' => 'email_weekly_digest', 'label' => 'Weekly digest', 'desc' => 'Summary of library activity for admins', 'checked' => false],
                ] as $item)
                    <div class="flex items-start justify-between gap-4 p-4 bg-background dark:bg-white/5 rounded-xl border border-border dark:border-white/10">
                        <div>
                            <p class="text-sm font-medium text-secondary dark:text-white">{{ $item['label'] }}</p>
                            <p class="mt-0.5 text-xs text-secondary/50 dark:text-white/50">{{ $item['desc'] }}</p>
                        </div>
                        <x-ui.checkbox :name="$item['name']" :checked="$item['checked']" class="!gap-0 shrink-0" />
                    </div>
                @endforeach
            </div>
        </x-shared.form-section>

        <x-shared.form-section title="SMS Notifications" description="Configure text message alerts for critical events.">
            <div class="mb-5 p-4 bg-warning/5 dark:bg-warning/10 border border-warning/20 rounded-xl">
                <div class="flex items-start gap-3">
                    <x-ui.icon name="exclamation-triangle" class="w-5 h-5 text-warning shrink-0 mt-0.5" />
                    <div>
                        <p class="text-sm font-medium text-secondary dark:text-white">SMS provider required</p>
                        <p class="mt-1 text-xs text-secondary/60 dark:text-white/60">Connect an SMS gateway in System settings to enable text notifications.</p>
                    </div>
                </div>
            </div>

            <div class="space-y-4">
                @foreach ([
                    ['name' => 'sms_overdue', 'label' => 'Overdue alerts', 'desc' => 'SMS when book is 3+ days overdue', 'checked' => false],
                    ['name' => 'sms_fine_threshold', 'label' => 'Fine threshold alert', 'desc' => 'SMS when unpaid fines exceed Rp 100,000', 'checked' => false],
                    ['name' => 'sms_security', 'label' => 'Security alerts', 'desc' => 'SMS for suspicious login attempts', 'checked' => true],
                    ['name' => 'sms_reservation', 'label' => 'Reservation ready', 'desc' => 'SMS when reserved book becomes available', 'checked' => false],
                ] as $item)
                    <div class="flex items-start justify-between gap-4 p-4 bg-background dark:bg-white/5 rounded-xl border border-border dark:border-white/10">
                        <div>
                            <p class="text-sm font-medium text-secondary dark:text-white">{{ $item['label'] }}</p>
                            <p class="mt-0.5 text-xs text-secondary/50 dark:text-white/50">{{ $item['desc'] }}</p>
                        </div>
                        <x-ui.checkbox :name="$item['name']" :checked="$item['checked']" class="!gap-0 shrink-0" />
                    </div>
                @endforeach
            </div>

            <div class="flex items-center justify-end gap-3 pt-6 mt-6 border-t border-border dark:border-white/10">
                <x-ui.button variant="outline" type="button">Reset</x-ui.button>
                <x-ui.button variant="primary" type="button">
                    <x-ui.icon name="check" class="w-4 h-4" />
                    Save Settings
                </x-ui.button>
            </div>
        </x-shared.form-section>
    </div>
@endsection
