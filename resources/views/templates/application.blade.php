@extends('templates.default')

@section('body')
    <x-navbar :items="[
        'Dashboard' => 'app.dashboard',
    ]">
    </x-navbar>
    @yield('content')
@endsection
