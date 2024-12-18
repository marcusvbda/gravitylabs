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
    @vite(['resources/scss/app.scss', 'resources/js/app.js'])
    @livewireStyles
</head>

<body style="--theme-color: @yield('theme-color', config('app.default_theme_color'))">
    @yield('body')
</body>
@livewireScripts

</html>

<script>
    document.addEventListener('livewire:init', () => {
        const showMessages = (messages) => {
            const colors = {
                'success': '#65a30d',
                'error': '#e11d48',
                'warning': '#d97706',
            };
            messages.forEach((message) => {
                Toastify({
                    text: message.text,
                    duration: 5000,
                    close: true,
                    position: "right",
                    stopOnFocus: true,
                    style: {
                        background: colors[message.type],
                    }
                }).showToast();
            });
        }

        @if (session('messages'))
            let sessionMessages = @json(session('messages'));
            showMessages(sessionMessages);
        @endif

        let cleanup = Livewire.on('sendMessage', (data) => {
            showMessages(data);
        });
    });
</script>
