<div x-data="{ focused: false }"
    :class="focused ? 'ring-primary-600 border-primary-600 dark:ring-blue-500 dark:border-blue-500' :
        'border-gray-300 dark:border-gray-600'"
    class="w-100 flex-col relative bg-gray-50 border readonly:opacity-50 text-gray-900 rounded-lg
    focus-within:ring-primary-600 focus-within:border-primary-600 block w-full dark:bg-gray-700
    dark:placeholder-gray-400 dark:text-white">
    @if (@$label)
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            {{ $label }}
        </label>
    @endif
    <select wire:loading.attr="readonly"
        class="bg-transparent p-2.5 w-full focus:outline-none {{ @$inputClass ?? '' }} appearance-none"
        @if (@$model) wire:model{{ @$modelType ? '.' . $modelType : '' }}="{{ $model }}" @endif
        placeholder="{{ $placeholder ?? '' }}" {{ @$required ? 'required' : '' }} @focus="focused = true"
        @blur="focused = false">

        {{ $slot }}
    </select>
    <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
        <x-icons.arrow-down class="size-5" />
    </div>
</div>
