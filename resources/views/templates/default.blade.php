<!DOCTYPE html>
@php
    $defaultTheme = config('app.default_theme');
@endphp
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="@yield('theme', $defaultTheme)">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ config('app.logo') }}" type="image/x-icon">

    <title>{{ config('app.name') }} | @yield('title')</title>

    <!-- Styles / Scripts -->
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    @livewireStyles
</head>

<body>
    @yield('body')
</body>
@livewireScripts

</html>
