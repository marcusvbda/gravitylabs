@extends('templates.default')

@section('body')
    <x-navbar :items="[
        'Apps' => 'app.applications.index',
    ]">
    </x-navbar>
    <div class="flex flex-col md:flex-row">
        @hasSection('sidebar')
            <aside class="bg-gray-200 dark:bg-gray-800 border-r border-gray-300/50 dark:border-gray-700 w-full md:w-2/12">
                @yield('sidebar')
            </aside>
        @endif
        <div class="w-full @hasSection('name')
md:w-10/12
@endif p-4 sm:p-6 lg:p-8 bg-gray-100 dark:bg-gray-900">
            @yield('content')
        </div>
    </div>
    <x-footer></x-footer>
@endsection
