@extends('layouts.landing')

@section('content')
    <x-landing.navbar />

    <main>
        <x-landing.hero />
        <x-landing.statistics :stats="$landingStats" />
        <x-landing.features />
        <x-landing.dashboard-preview :stats="$landingStats" :activity="$landingActivity" />
        <x-landing.how-it-works />
        <x-landing.popular-books :books="$landingBooks" />
        <x-landing.security />
        <x-landing.testimonials />
        <x-landing.cta />
    </main>

    <x-landing.footer />
@endsection
