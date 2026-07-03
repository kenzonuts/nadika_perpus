@extends('layouts.auth')

@section('content')
    <x-auth.card
        title="Confirm password"
        subtitle="This is a secure area. Please confirm your password before continuing."
    >
        <form
            method="POST"
            action="{{ route('password.confirm.store') }}"
            x-data="formSubmit"
            @submit="submit"
            class="space-y-5"
        >
            @csrf
            <x-ui.password-input
                label="Password"
                name="password"
                placeholder="Enter your password"
                required
            />

            <x-auth.submit-button loading-text="Confirming...">
                Confirm
            </x-auth.submit-button>
        </form>
    </x-auth.card>
@endsection
