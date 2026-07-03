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

        <x-shared.page-toolbar title="Library Settings" subtitle="Configure borrowing rules and fine policies." />

        <x-shared.form-section title="Borrowing & Fine Rules" description="Set limits and policies for book circulation.">
            <form method="POST" action="{{ route('settings.update') }}" class="space-y-5">
                @csrf
                @method('PATCH')
                <input type="hidden" name="group" value="library">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <x-ui.input label="Max Books Per Member" name="settings[borrow_limit]" type="number" :value="$borrow_limit ?? '3'" hint="Maximum books a member can borrow at once." />
                    <x-ui.input label="Borrowing Period (days)" name="settings[loan_duration]" type="number" :value="$loan_duration ?? '14'" hint="Default loan duration in days." />
                    <x-ui.input label="Fine Rate (per day, IDR)" name="settings[fine_per_day]" type="number" :value="$fine_per_day ?? '5000'" hint="Amount charged per overdue day." />
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-border dark:border-white/10">
                    <x-ui.button variant="primary" type="submit">
                        <x-ui.icon name="check" class="w-4 h-4" />
                        Save Settings
                    </x-ui.button>
                </div>
            </form>
        </x-shared.form-section>
    </div>
@endsection
