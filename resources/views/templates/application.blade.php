@extends('templates.default')

@section('body')
    <x-navbar :items="[
        'Apps' => 'app.applications.index',
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
@endif  bg-gray-100 dark:bg-gray-900 p-8 md:py-10 min-h-screen">
            @yield('content')
        </div>
    </div>
    <x-footer />
@endsection
