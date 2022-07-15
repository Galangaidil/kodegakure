<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Source+Serif+Pro:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
</head>
<body>
<div class="font-sans text-gray-900 antialiased">
    @include('layouts.top-header')

    <main class="bg-gray-50 py-0 lg:py-2.5">
        {{ $slot }}
    </main>

    @include('layouts.bottom-navigation')
</div>

<script src="{{ asset('js/jquery.min.js') }}"></script>

@yield('script')
</body>
</html>