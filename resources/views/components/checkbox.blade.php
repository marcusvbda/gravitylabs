<label class="flex items-start cursor-pointer">
    <div class="flex items-center h-5">
        <input type="checkbox" wire:loading.attr="disabled"
            @if ($model) wire:model{{ @$modelType ? '.' . $modelType : '' }}="{{ $model }}" @endif
            class="w-4 h-4 border disabled:opacity-25 border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800">
    </div>
    <div class="ml-3 text-sm">
        <span class="text-gray-500 dark:text-gray-300">{{ $label }}</span>
    </div>
</label>
