@extends('layouts.auth')

@section('content')
    <x-auth.card
        title="Welcome back"
        subtitle="Sign in to your Smart Library account to continue."
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
                label="Password"
                name="password"
                placeholder="Enter your password"
                required
            />

            <div class="flex items-center justify-between gap-4">
                <x-ui.checkbox name="remember" id="remember">
                    Remember me
                </x-ui.checkbox>

                <a
                    href="{{ url('/forgot-password') }}"
                    class="text-sm font-medium text-primary hover:text-primary-dark dark:hover:text-primary-light transition-colors focus:outline-none focus:ring-2 focus:ring-primary/20 rounded"
                >
                    Forgot password?
                </a>
            </div>

            <x-auth.submit-button loading-text="Signing in...">
                Sign In
            </x-auth.submit-button>

            <x-ui.divider />

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <x-ui.social-button provider="google" />
                <x-ui.social-button provider="github" />
            </div>
        </form>

        <p class="mt-8 text-center text-sm text-secondary/60 dark:text-white/60">
            Don't have an account?
            <a
                href="{{ url('/register') }}"
                class="font-medium text-primary hover:text-primary-dark dark:hover:text-primary-light transition-colors focus:outline-none focus:ring-2 focus:ring-primary/20 rounded"
            >
                Register
            </a>
        </p>
    </x-auth.card>
@endsection
