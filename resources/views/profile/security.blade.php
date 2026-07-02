@extends('layouts.dashboard')

@section('breadcrumb')
    <x-dashboard.breadcrumb :items="[
        ['label' => 'Dashboard', 'href' => url('/dashboard')],
        ['label' => 'Profile', 'href' => url('/profile')],
        ['label' => 'Security', 'active' => true],
    ]" />
@endsection

@section('content')
    <div class="max-w-[800px] mx-auto space-y-6" x-data="{ twoFactorEnabled: false }">
        <x-profile.tabs active="security" />

        <x-shared.page-toolbar title="Security" subtitle="Manage your password and two-factor authentication settings." />

        <x-shared.form-section title="Change Password" description="Ensure your account uses a strong, unique password.">
            <form class="space-y-5 max-w-md">
                <x-ui.password-input label="Current Password" name="current_password" required />
                <x-ui.password-input label="New Password" name="new_password" hint="Must be at least 12 characters with uppercase, lowercase, and numbers." required />
                <x-ui.password-input label="Confirm New Password" name="new_password_confirmation" required />

                <div class="flex items-center justify-end gap-3 pt-4">
                    <x-ui.button variant="primary" type="button">
                        <x-ui.icon name="lock-closed" class="w-4 h-4" />
                        Update Password
                    </x-ui.button>
                </div>
            </form>
        </x-shared.form-section>

        <x-shared.form-section title="Two-Factor Authentication" description="Add an extra layer of security to your account.">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 p-4 bg-background dark:bg-white/5 rounded-xl border border-border dark:border-white/10">
                <div class="flex items-start gap-4">
                    <div class="w-11 h-11 rounded-xl bg-primary/10 dark:bg-primary/20 flex items-center justify-center shrink-0">
                        <x-ui.icon name="shield-check" class="w-5 h-5 text-primary" />
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-secondary dark:text-white">Authenticator App</p>
                        <p class="mt-1 text-sm text-secondary/50 dark:text-white/50">
                            Use an authenticator app like Google Authenticator or Authy to generate verification codes.
                        </p>
                        <span class="mt-2 inline-block">
                            <x-ui.badge variant="success" x-show="twoFactorEnabled" x-cloak>Enabled</x-ui.badge>
                            <x-ui.badge variant="neutral" x-show="!twoFactorEnabled">Disabled</x-ui.badge>
                        </span>
                    </div>
                </div>
                <button
                    type="button"
                    @click="twoFactorEnabled = !twoFactorEnabled"
                    :class="twoFactorEnabled ? 'bg-success' : 'bg-secondary/20 dark:bg-white/10'"
                    class="relative inline-flex h-7 w-12 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-primary/20"
                    role="switch"
                    :aria-checked="twoFactorEnabled"
                >
                    <span
                        :class="twoFactorEnabled ? 'translate-x-5' : 'translate-x-0.5'"
                        class="pointer-events-none inline-block h-6 w-6 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
                    ></span>
                </button>
            </div>

            <div x-show="twoFactorEnabled" x-cloak x-transition class="mt-4 p-4 bg-success/5 dark:bg-success/10 border border-success/20 rounded-xl">
                <p class="text-sm font-medium text-success">Two-factor authentication is active</p>
                <p class="mt-1 text-sm text-secondary/60 dark:text-white/60">Your account is protected with TOTP verification on every login.</p>
                <div class="flex gap-2 mt-4">
                    <x-ui.button variant="outline" size="sm" type="button">View Recovery Codes</x-ui.button>
                    <x-ui.button variant="outline" size="sm" type="button" class="!text-danger !border-danger/30">Disable 2FA</x-ui.button>
                </div>
            </div>

            <div x-show="!twoFactorEnabled" x-transition class="mt-4">
                <x-ui.button variant="primary" size="sm" type="button" @click="twoFactorEnabled = true">
                    <x-ui.icon name="shield-check" class="w-4 h-4" />
                    Enable Two-Factor Authentication
                </x-ui.button>
            </div>
        </x-shared.form-section>

        <x-shared.form-section title="Active Sessions" description="Manage devices where you're currently logged in.">
            <div class="space-y-3">
                @foreach ([
                    ['device' => 'Chrome on macOS', 'location' => 'Jakarta, Indonesia', 'current' => true, 'time' => 'Active now'],
                    ['device' => 'Safari on iPhone', 'location' => 'Jakarta, Indonesia', 'current' => false, 'time' => '2 days ago'],
                ] as $session)
                    <div class="flex items-center justify-between gap-4 p-4 bg-background dark:bg-white/5 rounded-xl border border-border dark:border-white/10">
                        <div class="flex items-center gap-3">
                            <x-ui.icon :name="$session['current'] ? 'user-circle' : 'bell'" class="w-5 h-5 text-secondary/50 dark:text-white/50" />
                            <div>
                                <p class="text-sm font-medium text-secondary dark:text-white">
                                    {{ $session['device'] }}
                                    @if ($session['current'])
                                        <x-ui.badge variant="success" class="ml-2">Current</x-ui.badge>
                                    @endif
                                </p>
                                <p class="text-xs text-secondary/50 dark:text-white/50">{{ $session['location'] }} · {{ $session['time'] }}</p>
                            </div>
                        </div>
                        @unless ($session['current'])
                            <x-ui.button variant="outline" size="sm" type="button" class="!text-danger !border-danger/30 shrink-0">Revoke</x-ui.button>
                        @endunless
                    </div>
                @endforeach
            </div>
        </x-shared.form-section>
    </div>
@endsection
