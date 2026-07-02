@extends('layouts.auth')

@section('content')
    <x-auth.card
        title="Confirm password"
        subtitle="This is a secure area. Please confirm your password before continuing."
    >
        <form
            x-data="formSubmit"
            @submit="submit"
            class="space-y-5"
            novalidate
        >
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
