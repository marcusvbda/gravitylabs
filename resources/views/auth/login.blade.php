@extends('templates.auth')
@section('title', 'Login')
@section('description', 'Sign in to your account')

@section('content')
    @livewire('auth.login-form')
@endsection
