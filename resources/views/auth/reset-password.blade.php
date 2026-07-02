@extends('layouts.auth')

@section('content')
    <x-auth.card
        title="Reset password"
        subtitle="Enter your new password below to regain access to your account."
    >
        <form
            x-data="formSubmit"
            @submit="submit"
            class="space-y-5"
            novalidate
        >
            <x-ui.input
                label="Email address"
                name="email"
                type="email"
                placeholder="you@example.com"
                autocomplete="email"
                required
            />

            <x-ui.password-input
                label="New password"
                name="password"
                placeholder="Enter new password"
                autocomplete="new-password"
                hint="Must be at least 8 characters"
                required
            />

            <x-ui.password-input
                label="Confirm password"
                name="password_confirmation"
                placeholder="Confirm new password"
                autocomplete="new-password"
                required
            />

            <x-auth.submit-button loading-text="Resetting...">
                Reset Password
            </x-auth.submit-button>
        </form>

        <p class="mt-8 text-center text-sm text-secondary/60 dark:text-white/60">
            <a
                href="{{ url('/login') }}"
                class="inline-flex items-center gap-1.5 font-medium text-primary hover:text-primary-dark dark:hover:text-primary-light transition-colors focus:outline-none focus:ring-2 focus:ring-primary/20 rounded"
            >
                <x-ui.icon name="arrow-left" class="w-4 h-4" />
                Back to login
            </a>
        </p>
    </x-auth.card>
@endsection
