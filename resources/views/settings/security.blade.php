@extends('layouts.dashboard')

@section('breadcrumb')
    <x-dashboard.breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => url('/dashboard')],
        ['label' => 'Settings', 'href' => url('/settings/general')],
        ['label' => 'Security', 'active' => true],
    ]" />
@endsection

@section('content')
    <div class="max-w-[800px] mx-auto space-y-6">
        <x-settings.tabs active="security" />

        <x-shared.page-toolbar title="Security Settings" subtitle="Configure password policies and session management.">
            <x-ui.button variant="primary" size="sm" type="button">
                <x-ui.icon name="check" class="w-4 h-4" />
                Save Changes
            </x-ui.button>
        </x-shared.page-toolbar>

        <x-shared.form-section title="Password Policy" description="Enforce password requirements for all users.">
            <form class="space-y-5">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <x-ui.input label="Minimum Length" name="min_password_length" type="number" value="12" />
                    <x-ui.input label="Password Expiry (days)" name="password_expiry" type="number" value="90" hint="0 = never expires" />
                </div>

                <div class="space-y-3">
                    <x-ui.checkbox name="require_uppercase" :checked="true">
                        Require at least one uppercase letter
                    </x-ui.checkbox>
                    <x-ui.checkbox name="require_lowercase" :checked="true">
                        Require at least one lowercase letter
                    </x-ui.checkbox>
                    <x-ui.checkbox name="require_numbers" :checked="true">
                        Require at least one number
                    </x-ui.checkbox>
                    <x-ui.checkbox name="require_special" :checked="true">
                        Require at least one special character
                    </x-ui.checkbox>
                    <x-ui.checkbox name="prevent_reuse" :checked="true">
                        Prevent reuse of last 5 passwords
                    </x-ui.checkbox>
                </div>
            </form>
        </x-shared.form-section>

        <x-shared.form-section title="Session Management" description="Control login sessions and timeout behavior.">
            <form class="space-y-5">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div>
                        <x-ui.label for="session_timeout">Session Timeout (minutes)</x-ui.label>
                        <select id="session_timeout" name="session_timeout" class="block w-full px-4 py-3 text-sm text-secondary dark:text-white bg-card dark:bg-secondary/50 border border-border dark:border-white/10 rounded-xl focus:outline-none focus:ring-2 focus:ring-primary/20">
                            <option value="15">15 minutes</option>
                            <option value="30">30 minutes</option>
                            <option value="60" selected>1 hour</option>
                            <option value="120">2 hours</option>
                            <option value="480">8 hours</option>
                        </select>
                    </div>
                    <x-ui.input label="Max Concurrent Sessions" name="max_sessions" type="number" value="3" hint="Per user account" />
                </div>

                <div class="space-y-3">
                    <x-ui.checkbox name="force_logout_password_change" :checked="true">
                        Force logout on all devices when password is changed
                    </x-ui.checkbox>
                    <x-ui.checkbox name="remember_me" :checked="true">
                        Allow "Remember me" on login
                    </x-ui.checkbox>
                    <x-ui.checkbox name="ip_restriction" :checked="false">
                        Restrict admin access to specific IP addresses
                    </x-ui.checkbox>
                </div>

                <div class="flex items-center justify-end gap-3 pt-4 border-t border-border dark:border-white/10">
                    <x-ui.button variant="outline" type="button">Reset</x-ui.button>
                    <x-ui.button variant="primary" type="button">
                        <x-ui.icon name="check" class="w-4 h-4" />
                        Save Settings
                    </x-ui.button>
                </div>
            </form>
        </x-shared.form-section>
    </div>
@endsection
