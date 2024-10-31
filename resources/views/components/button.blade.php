@php
    $colors = [
        'primary' =>
            'text-white bg-primary-600 hover:bg-primary-700 focus:ring-primary-300  dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 disabled:hover:bg-primary-600',
    ];
@endphp

<button type="{{ $type ?? 'button' }}" @if (@$type == 'submit') wire:loading.attr="disabled" @endif
    class="{{ $class ?? '' }} disabled:opacity-25 focus:ring-4 focus:outline-none  font-medium rounded-lg text-sm px-5 py-2.5 text-center {{ data_get($colors, $color ?? 'primary') }}">
    <div class="flex justify-center items-center gap-2">
        {{ $slot }}
        @if (@$type == 'submit')
            <div wire:loading>
                <x-spinner class="size-4" />
            </div>
        @endif
    </div>
</button>
