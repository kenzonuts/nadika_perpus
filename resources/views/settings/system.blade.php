@extends('layouts.dashboard')

@section('breadcrumb')
    <x-dashboard.breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => url('/dashboard')],
        ['label' => 'Settings', 'href' => url('/settings/general')],
        ['label' => 'System', 'active' => true],
    ]" />
@endsection

@section('content')
    <div class="max-w-[800px] mx-auto space-y-6" x-data="{ maintenanceMode: false, deleteModalOpen: false }">
        <x-settings.tabs active="system" />

        <x-shared.page-toolbar title="System Settings" subtitle="Maintenance mode and advanced system configuration.">
            <x-ui.button variant="primary" size="sm" type="button">
                <x-ui.icon name="check" class="w-4 h-4" />
                Save Changes
            </x-ui.button>
        </x-shared.page-toolbar>

        <x-shared.form-section title="Maintenance Mode" description="Temporarily disable public access for updates or maintenance.">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 p-4 bg-background dark:bg-white/5 rounded-xl border border-border dark:border-white/10">
                <div class="flex items-start gap-4">
                    <div class="w-11 h-11 rounded-xl bg-warning/10 dark:bg-warning/20 flex items-center justify-center shrink-0">
                        <x-ui.icon name="cog-6-tooth" class="w-5 h-5 text-warning" />
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-secondary dark:text-white">Maintenance Mode</p>
                        <p class="mt-1 text-sm text-secondary/50 dark:text-white/50">
                            When enabled, only administrators can access the system. All other users see a maintenance page.
                        </p>
                    </div>
                </div>
                <button
                    type="button"
                    @click="maintenanceMode = !maintenanceMode"
                    :class="maintenanceMode ? 'bg-warning' : 'bg-secondary/20 dark:bg-white/10'"
                    class="relative inline-flex h-7 w-12 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-primary/20"
                    role="switch"
                    :aria-checked="maintenanceMode"
                >
                    <span
                        :class="maintenanceMode ? 'translate-x-5' : 'translate-x-0.5'"
                        class="pointer-events-none inline-block h-6 w-6 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
                    ></span>
                </button>
            </div>

            <div x-show="maintenanceMode" x-cloak x-transition class="mt-4 space-y-4">
                <div class="p-4 bg-warning/5 dark:bg-warning/10 border border-warning/20 rounded-xl">
                    <p class="text-sm font-medium text-warning">Maintenance mode is active</p>
                    <p class="mt-1 text-sm text-secondary/60 dark:text-white/60">Non-admin users cannot access the library until maintenance is disabled.</p>
                </div>
                <div>
                    <x-ui.label for="maintenance_message">Maintenance Message</x-ui.label>
                    <textarea
                        id="maintenance_message"
                        name="maintenance_message"
                        rows="3"
                        class="block w-full px-4 py-3 text-sm text-secondary dark:text-white bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-xl placeholder:text-secondary/40 focus:outline-none focus:ring-2 focus:ring-primary/20 resize-none"
                    >We're performing scheduled maintenance. Please check back soon.</textarea>
                </div>
            </div>
        </x-shared.form-section>

        <x-shared.form-section title="System Information" description="Current system status and version details.">
            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                @foreach ([
                    ['Application Version', 'v2.4.1'],
                    ['Laravel Version', '12.x'],
                    ['PHP Version', '8.3'],
                    ['Database', 'MySQL 8.0'],
                    ['Cache Driver', 'Redis'],
                    ['Queue Driver', 'Redis'],
                    ['Last Backup', 'Jul 2, 2026 03:00 AM'],
                    ['Uptime', '99.97%'],
                ] as [$label, $value])
                    <div class="flex justify-between gap-4 p-3 bg-background dark:bg-white/5 rounded-xl">
                        <dt class="text-secondary/50 dark:text-white/50">{{ $label }}</dt>
                        <dd class="font-medium text-secondary dark:text-white">{{ $value }}</dd>
                    </div>
                @endforeach
            </dl>
        </x-shared.form-section>

        <x-shared.form-section title="Danger Zone" description="Irreversible and destructive actions. Proceed with caution.">
            <div class="space-y-4">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 p-4 border border-danger/20 bg-danger/5 dark:bg-danger/10 rounded-xl">
                    <div>
                        <p class="text-sm font-semibold text-danger">Clear All Cache</p>
                        <p class="mt-1 text-sm text-secondary/60 dark:text-white/60">Flush application, config, route, and view caches.</p>
                    </div>
                    <x-ui.button variant="outline" size="sm" type="button" class="!text-danger !border-danger/30 shrink-0">
                        Clear Cache
                    </x-ui.button>
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 p-4 border border-danger/20 bg-danger/5 dark:bg-danger/10 rounded-xl">
                    <div>
                        <p class="text-sm font-semibold text-danger">Reset All Settings</p>
                        <p class="mt-1 text-sm text-secondary/60 dark:text-white/60">Restore all settings to factory defaults. This cannot be undone.</p>
                    </div>
                    <x-ui.button variant="outline" size="sm" type="button" class="!text-danger !border-danger/30 shrink-0">
                        Reset Settings
                    </x-ui.button>
                </div>

                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 p-4 border-2 border-danger/30 bg-danger/5 dark:bg-danger/10 rounded-xl">
                    <div>
                        <p class="text-sm font-semibold text-danger">Delete All Data</p>
                        <p class="mt-1 text-sm text-secondary/60 dark:text-white/60">
                            Permanently delete all books, members, borrowings, and transaction history. This action is irreversible.
                        </p>
                    </div>
                    <x-ui.button variant="primary" size="sm" type="button" class="!bg-danger hover:!bg-danger/90 shrink-0" @click="deleteModalOpen = true">
                        <x-ui.icon name="trash" class="w-4 h-4" />
                        Delete All Data
                    </x-ui.button>
                </div>
            </div>
        </x-shared.form-section>

        <x-shared.confirm-modal
            title="Delete All Data"
            message="This will permanently delete all library data including books, members, borrowings, fines, and audit logs. This action cannot be undone."
            confirm-label="Yes, Delete Everything"
            cancel-label="Cancel"
            :danger="true"
        >
            <x-ui.input label="Type DELETE to confirm" name="confirm_delete" placeholder="DELETE" class="!mt-0" />
        </x-shared.confirm-modal>
    </div>
@endsection
