<div class="p-2 bg-primary-100 dark:bg-gray-800 rounded-3xl flex items-center group cursor-pointer"
    data-code="{{ $code }}">
    <div
        class="size-14 min-w-14 bg-primary-600 rounded-2xl flex items-center justify-center text-white text-2xl font-bold">
        {{ substr($name, 0, 1) }}
    </div>
    <div class="flex-1 flex flex-col gap-2 px-4 overflow-hidden">
        <h4 class="font-bold text-primary-600 text-base truncate">
            {{ $name }}
        </h4>
        <small class="text-gray-500 text-xs">
            {{ $description }}
        </small>
    </div>
    <div class="text-gray-700 group-hover:text-blue-600 transition duration-300">
        <x-icons.entity-item />
    </div>
</div>
