@extends('layouts.landing')

@section('content')
    <x-landing.navbar />

    <main>
        <x-landing.hero />
        <x-landing.statistics />
        <x-landing.features />
        <x-landing.dashboard-preview />
        <x-landing.how-it-works />
        <x-landing.popular-books />
        <x-landing.security />
        <x-landing.testimonials />
        <x-landing.cta />
    </main>

    <x-landing.footer />
@endsection
