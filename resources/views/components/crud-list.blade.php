{{-- @section('shortcust', null) --}}
@section('shortcust')
    <x-sidebar></x-sidebar>
@endsection

<h4
    class="text-3xl flex items-center gap-2 text-gray-800 dark:text-white border-b border-gray-200 dark:border-gray-700 pb-6">
    {{ $icon }}
    {{ $title }}
    <x-button class="ml-auto">
        {{ $createBtnText }}
    </x-button>
</h4>

<div class="text-lg flex items-center gap-2 text-gray-800 dark:text-white mt-6">
    @php
        $qty = 0;
    @endphp
    {{ $qty }} {{ $qty === 0 ? $plural : ($qty > 1 ? $plural : $label) }}
</div>

<div class="gap-4 mt-4 grid grid-cols-1 md:grid-cols-2">
    <x-input type="text" placeholder="Search..." inputClass="p-3">
        <x-slot name="append">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M21 21L17.5 17.5M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" />
            </svg>
        </x-slot>
    </x-input>
    <x-select inputClass="py-3">
        <option>Sort by recently updated</option>
        <option>Sort by name</option>
    </x-select>
</div>
