@extends('layouts.default')
@section('theme', Auth::user()->settings?->theme ?? config('app.default_theme'))
@section('title', $title)

@section('body')
    <x-navbar :items="[
            // 'My apps' => 'app.applications.index',
            // 'Test' => 'app.test',
        ]" />
    <div class="flex flex-col md:flex-row">
        @hasSection('shortcust')
            <aside class="bg-gray-200 dark:bg-gray-800 border-r border-gray-300/50 dark:border-gray-700 w-full md:w-2/12">
                @yield('shortcust')
            </aside>
        @endif
        <div
            class="w-full @hasSection('name')
md:w-10/12
@endif  bg-gray-100 dark:bg-gray-900 py-8 md:py-10 px-4 md:px-6 min-h-screen">
            {{ $slot }}
        </div>
    </div>
    @persist('footer')
        <x-footer />
    @endpersist
@endsection
