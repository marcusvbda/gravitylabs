<div style="--item-default-color: {{ $item->primary_color }}">
    <div class="p-2 dark:bg-gray-800 rounded-3xl flex items-center group cursor-pointer"
        style="background-color: {{ $item->primary_color . '17' }}" data-code="{{ $item->code }}">
        <div class="size-14 min-w-14 rounded-2xl flex items-center justify-center text-white text-2xl font-bold"
            style="background-color: var(--item-default-color)">
            {{ strtoupper(substr($item->name, 0, 1)) }}
        </div>
        <div class="flex-1 flex flex-col gap-2 px-4 overflow-hidden">
            <h4 class="font-bold text-base truncate" style="color: var(--item-default-color)">
                {{ $item->name }}
            </h4>
            <small class="text-gray-500 text-xs">
                {{ 'Last updated at ' . $item->updated_at->format('M d, Y') }}
            </small>
        </div>
        <div class="text-gray-700 group-hover:text-[var(--item-default-color)] transition duration-200">
            <x-icons.entity-item wire:key="crud_entity_item_{{ $item->id }}" />
        </div>
    </div>
</div>
