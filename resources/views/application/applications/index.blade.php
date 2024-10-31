@extends('templates.application')
@section('title', 'Dashboard')
@section('theme', Auth::user()->settings?->theme ?? config('app.default_theme'))

@section('content')
    @livewire('crud.index', [
        'title' => 'Apps',
        'label' => 'app',
        'plural' => 'apps',
        'icon' => '<svg class="size-14" viewBox="0 0 24 24" fill="none">
                            <path
                                        d="M6 8H6.01M9 8H9.01M12 8H12.01M4 11H20M4 19H20C20.5523 19 21 18.5523 21 18V6C21 5.44772 20.5523 5 20 5H4C3.44772 5 3 5.44772 3 6V18C3 18.5523 3.44772 19 4 19Z"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>',
        'createBtnText' => 'Create an App',
    ])
@endsection
