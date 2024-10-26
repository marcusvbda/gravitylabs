@extends('templates.default')

@section('body')
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                <img class="w-8 h-8 mr-2" src="{{ config('app.logo') }}" alt="logo">
                {{ config('app.name') }}
            </div>
            <x-card>
                <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                    @yield('description')
                </h1>
                @livewire('messages')
                @yield('content')
            </x-card>
        </div>
    </section>
@endsection
