@php
    $colors = [
        'primary' =>
            'text-white bg-primary-600 hover:bg-primary-700 focus:ring-primary-300  dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 disabled:hover:bg-primary-600',
    ];
    $customClass = data_get($attributes, 'class', '');
    $colorClass = data_get($colors, data_get($attributes, 'color', 'primary'));
    $class = "disabled:opacity-25 focus:ring-4 focus:outline-none  font-medium rounded-lg text-sm px-5 py-2.5 text-center $customClass $colorClass";
    $wireClick = data_get($attributes, 'wire:click', '');
    $xoOnClick = data_get($attributes, 'x-on:click', '');
@endphp

<button type="{{ $type ?? 'button' }}" @if (@$type == 'submit') wire:loading.attr="disabled" @endif
    @if ($wireClick) wire:click="{{ $wireClick }}" @endif class="{{ $class }}"
    @if ($xoOnClick) x-on:click="{{ $xoOnClick }}" @endif>
    <div class="flex justify-center items-center gap-2">
        {{ $slot }}
        @if (@$type == 'submit')
            <div wire:loading>
                <x-spinner class="size-4" />
            </div>
        @endif
    </div>
</button>
