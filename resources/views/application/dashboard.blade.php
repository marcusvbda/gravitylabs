@extends('templates.application')
@section('title', 'Dashboard')
@section('theme', Auth::user()->settings?->theme ?? config('app.default_theme'))

@section('content')
    DASHBOARD
@endsection
