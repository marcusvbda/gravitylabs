@extends('templates.auth')
@section('title', 'Login')
@section('description', 'Sign in to your account')

@section('content')
    <form class="space-y-4 md:space-y-6" action="#">
        {{-- @livewire('counter') --}}
        <x-input label="Your Email" type="email" placeholder="name@company.com" />
        <x-input label="Password" type="password" placeholder="••••••••" />
        <div class="flex items-center justify-between">
            <x-checkbox label="Remember me" />
            {{-- <x-link href="#">Forgot password?</x-link> --}}
        </div>
        <x-button class="w-full" type="submit">Sign in</x-button>
        {{-- <p class="text-sm font-light text-gray-500 dark:text-gray-400">
            Don’t have an account yet? <x-link href="#">Sign up</x-link>
        </p> --}}
    </form>
@endsection
