@extends('templates.application')
@section('title', 'Dashboard')

@section('content')
    <a href="{{ route('auth.logout') }}">
        <x-button>Logout</x-button>
    </a>
@endsection
