@extends('layouts.auth')

@section('content')
    <x-auth.card
        title="Forgot password?"
        subtitle="No worries. Enter your email and we'll send you a reset link."
    >
        <form
            method="POST"
            action="{{ route('password.email') }}"
            x-data="formSubmit"
            @submit="submit"
            class="space-y-5"
        >
            @csrf
            <x-ui.input
                label="Email address"
                name="email"
                type="email"
                placeholder="you@example.com"
                autocomplete="email"
                required
            />

            <x-auth.submit-button loading-text="Sending link...">
                Send Reset Link
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
