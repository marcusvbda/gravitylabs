@php
    $wireClickOutside = data_get($attributes, 'x-on:click.outside', '');
    $size = data_get($attributes, 'size', 'w-full');
    $class = data_get($attributes, 'class', '');
@endphp

<div class="bg-white rounded-lg shadow dark:border md:mt-0 xl:p-0 dark:bg-gray-800 dark:border-gray-700 {{ $class }} {{ $size }}"
    {{ $attributes }}>
    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
        {{ $slot }}
    </div>
</div>
