@php
    $colors = [
        'primary' =>
            'text-white bg-primary-600 hover:bg-primary-700 focus:ring-primary-300  dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800',
    ];
@endphp

<button type="{{ $type ?? 'button' }}"
    class="{{ $class ?? '' }} focus:ring-4 focus:outline-none  font-medium rounded-lg text-sm px-5 py-2.5 text-center {{ data_get($colors, $color ?? 'primary') }}">
    {{ $slot }}
</button>
