@extends('layouts.dashboard')

@section('breadcrumb')
    <x-dashboard.breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => url('/dashboard')],
        ['label' => 'Settings', 'href' => url('/settings/general')],
        ['label' => 'Library', 'active' => true],
    ]" />
@endsection

@section('content')
    <div class="max-w-[800px] mx-auto space-y-6">
        <x-settings.tabs active="library" />

        <x-shared.page-toolbar title="Library Settings" subtitle="Configure borrowing rules and fine policies.">
            <x-ui.button variant="primary" size="sm" type="button">
                <x-ui.icon name="check" class="w-4 h-4" />
                Save Changes
            </x-ui.button>
        </x-shared.page-toolbar>

        <x-shared.form-section title="Borrowing Rules" description="Set limits and policies for book circulation.">
            <form class="space-y-5">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <x-ui.input label="Max Books Per Member" name="max_books" type="number" value="5" hint="Maximum books a member can borrow at once." />
                    <x-ui.input label="Borrowing Period (days)" name="borrow_days" type="number" value="14" hint="Default loan duration in days." />
                    <x-ui.input label="Renewal Limit" name="renewal_limit" type="number" value="2" hint="Maximum number of renewals allowed." />
                    <x-ui.input label="Renewal Extension (days)" name="renewal_days" type="number" value="7" hint="Additional days per renewal." />
                </div>

                <div class="space-y-3 pt-2">
                    <x-ui.checkbox name="allow_reservations" :checked="true">
                        Allow book reservations when all copies are borrowed
                    </x-ui.checkbox>
                    <x-ui.checkbox name="auto_renew" :checked="false">
                        Enable automatic renewal if no holds exist
                    </x-ui.checkbox>
                    <x-ui.checkbox name="block_overdue" :checked="true">
                        Block new borrowings when member has overdue books
                    </x-ui.checkbox>
                </div>
            </form>
        </x-shared.form-section>

        <x-shared.form-section title="Fine Settings" description="Configure late return penalties and grace periods.">
            <form class="space-y-5">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <x-ui.input label="Fine Rate (per day)" name="fine_rate" type="number" value="7500" hint="Amount charged per overdue day (IDR)." />
                    <x-ui.input label="Grace Period (days)" name="grace_period" type="number" value="1" hint="Days before fines start accruing." />
                    <x-ui.input label="Max Fine Per Book" name="max_fine" type="number" value="150000" hint="Maximum fine amount per book (IDR)." />
                    <x-ui.input label="Suspension Threshold" name="suspension_threshold" type="number" value="500000" hint="Total unpaid fines before suspension (IDR)." />
                </div>

                <div class="space-y-3 pt-2">
                    <x-ui.checkbox name="fines_enabled" :checked="true">
                        Enable fine collection for overdue books
                    </x-ui.checkbox>
                    <x-ui.checkbox name="email_fine_notice" :checked="true">
                        Send email notification when fine is issued
                    </x-ui.checkbox>
                    <x-ui.checkbox name="allow_fine_waiver" :checked="true">
                        Allow librarians to waive fines
                    </x-ui.checkbox>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-border dark:border-white/10">
                    <x-ui.button variant="outline" type="button">Reset to Defaults</x-ui.button>
                    <x-ui.button variant="primary" type="button">
                        <x-ui.icon name="check" class="w-4 h-4" />
                        Save Settings
                    </x-ui.button>
                </div>
            </form>
        </x-shared.form-section>
    </div>
@endsection
