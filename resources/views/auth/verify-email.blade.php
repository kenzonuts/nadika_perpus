@extends('layouts.auth')

@section('content')
    <x-auth.card>
        <div class="text-center">
            <div class="mx-auto w-16 h-16 bg-primary/10 dark:bg-primary/20 rounded-2xl flex items-center justify-center mb-6">
                <x-ui.icon name="envelope" class="w-8 h-8 text-primary" />
            </div>

            <h1 class="text-2xl font-bold text-secondary dark:text-white tracking-tight">
                Verify Your Email
            </h1>
            <p class="mt-3 text-sm text-secondary/60 dark:text-white/60 leading-relaxed max-w-sm mx-auto">
                Thanks for signing up! Before getting started, please verify your email address by clicking the link we sent you.
            </p>
        </div>

        <div
            x-data="formSubmit"
            class="mt-8 space-y-4"
        >
            <form @submit="submit">
                <x-auth.submit-button loading-text="Sending...">
                    Resend Verification Email
                </x-auth.submit-button>
            </form>

            <x-ui.button
                type="button"
                variant="outline"
                class="w-full"
                @click="submit($event)"
            >
                <span x-show="!loading">Log Out</span>
                <span x-show="loading" x-cloak class="inline-flex items-center justify-center gap-2">
                    <x-ui.spinner size="sm" />
                    Logging out...
                </span>
            </x-ui.button>
        </div>

        <p class="mt-6 text-center text-xs text-secondary/40 dark:text-white/40">
            Didn't receive the email? Check your spam folder or try resending.
        </p>
    </x-auth.card>
@endsection
