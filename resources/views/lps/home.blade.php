@extends('templates.default')
@section('theme', 'ligth')
@section('title', 'Home')

@section('body')

    <body class="dark:bg-black dark:text-white/50">
        <div class="flex min-h-full flex-col justify-center px-6 py-12 lg:px-8">
            <a href="{{ route('app.dashboard') }}">
                <x-button>Login</x-button>
            </a>
        </div>
    </body>
@endsection
