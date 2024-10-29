@extends('templates.default')

@section('body')
    <x-navbar :items="[
        'Dashboard' => 'app.dashboard',
    ]">
    </x-navbar>
    <div class="p-4 sm:p-6 lg:p-8 bg-gray-100 dark:bg-gray-900">
        @yield('content')
    </div>
    <x-footer></x-footer>
@endsection
