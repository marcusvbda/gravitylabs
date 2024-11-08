@php
    $class = 'flex justify-center min-h-screen px-4 text-center ' . data_get($attributes, 'class', '');
@endphp

<div x-cloak x-show="{{ $var }}"
    :class="{ 'fixed inset-0 z-50 overflow-y-auto': true, 'lock-scroll': {{ $var }} }"
    aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class=" {{ $class }}">
        <div x-show="{{ $var }}" x-transition:enter="transition ease-out duration-300 transform"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40"
            aria-hidden="true"></div>

        <div class="flex w-full h-fit justify-center transform">
            {{ $slot }}
        </div>
    </div>
</div>
