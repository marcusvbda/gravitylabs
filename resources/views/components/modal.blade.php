@php
    $class = 'flex justify-center min-h-screen text-center ' . data_get($attributes, 'class', '');
    $xShow = data_get($attributes, 'x-show', '');
    $events = data_get($attributes, 'events');
    $eventRender = '';
    foreach ($events ?? [] as $key => $value) {
        $eventRender .= "x-on:$key='$value' ";
    }

@endphp

<div x-cloak x-show="{{ $xShow }}" {!! $eventRender !!}
    :class="{ 'fixed inset-0 z-50 overflow-y-auto overflow-x-hidden': true, 'lock-scroll': {{ $xShow }} }"
    aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class=" {{ $class }}">
        <div x-show="{{ $xShow }}" x-transition:enter="transition ease-out duration-200 transform"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-200 transform" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-40"
            aria-hidden="true"></div>
        <div class="flex w-full h-auto justify-center transform">
            {{ $slot }}
        </div>
    </div>
</div>
