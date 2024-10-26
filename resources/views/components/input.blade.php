<div class="flex w-100 flex-col">
    @if (@$label)
        <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
            {{ $label }}
        </label>
    @endif
    <input wire:loading.attr="disabled" type="{{ $type ?? 'text' }}"
        @if ($model) wire:model{{ @$modelType ? '.' . $modelType : '' }}="{{ $model }}" @endif
        class="bg-gray-50 border disabled:opacity-50 border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder="{{ $placeholder ?? '' }}" {{ @$required ? 'required' : '' }}>
</div>
