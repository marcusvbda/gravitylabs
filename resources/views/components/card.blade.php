@php
    $wireClickOutside = data_get($attributes, 'x-on:click.outside', '');
    $size = data_get($attributes, 'size', 'w-full');
    $class = data_get($attributes, 'class', '');
    $xShow = data_get($attributes, 'x-show', '');
@endphp

<div @if ($xShow) x-show="{{ $xShow }}" x-cloak @endif
    class="bg-white rounded-lg dark:border md:mt-0 xl:p-0 dark:bg-gray-800 dark:border-gray-700 h-fit {{ $class }} {{ $size }}"
    {{ $attributes }}>
    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
        {{ $slot }}
    </div>
</div>
