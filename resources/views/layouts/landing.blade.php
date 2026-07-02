<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    @include('partials.head')
</head>
<body class="font-sans">
    @yield('content')

    @include('partials.scripts')
</body>
</html>
