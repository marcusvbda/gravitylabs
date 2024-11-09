@extends('templates.application')
@section('title', 'My Apps')
@section('theme', Auth::user()->settings?->theme ?? config('app.default_theme'))

@section('content')
    @livewire('crud.index', [
        'title' => 'Apps',
        'label' => 'app',
        'plural' => 'apps',
        'icon' => 'icons.apps',
        'createBtnText' => 'Create an App',
        'model' => \App\Models\Application::class,
    ])
@endsection
