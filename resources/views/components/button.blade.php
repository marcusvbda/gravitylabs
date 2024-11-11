@php
    $customClass = data_get($attributes, 'class', '');
    $class = "disabled:opacity-25 focus:ring-4 focus:outline-none  font-medium rounded-lg text-sm px-5 py-2.5 text-center text-white transition duration-200 hover:brightness-95 disabled:opacity-25 $customClass";
    $wireClick = data_get($attributes, 'wire:click', '');
    $xoOnClick = data_get($attributes, 'x-on:click', '');
@endphp

<button type="{{ $type ?? 'button' }}" @if (@$type == 'submit') wire:loading.attr="disabled" @endif
    style="background-color: var(--theme-color)"
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
