<div x-data="{ visible: false }" style="--theme-color: {{ $item->primary_color }}">
    <div class="p-2 dark:bg-gray-800 rounded-3xl flex items-center group cursor-pointer"
        style="background-color: {{ $item->primary_color . '17' }}" data-code="{{ $item->code }}"
        x-on:click="visible = true">
        <div class="size-14 min-w-14 rounded-2xl flex items-center justify-center text-white text-2xl font-bold"
            style="background-color: var(--theme-color)">
            {{ substr($item->name, 0, 1) }}
        </div>
        <div class="flex-1 flex flex-col gap-2 px-4 overflow-hidden">
            <h4 class="font-bold text-base truncate" style="color: var(--theme-color)">
                {{ $item->name }}
            </h4>
            <small class="text-gray-500 text-xs">
                {{ 'Last updated at ' . $item->updated_at->format('M d, Y') }}
            </small>
        </div>
        <div class="text-gray-700 group-hover:text-[var(--theme-color)] transition duration-200">
            <x-icons.entity-item />
        </div>
    </div>
    <x-modal x-show="visible">
        <x-card x-cloak x-on:click.outside="visible = false"
            class="w-full md:w-1/2 h-full transition transform translate-x-0 md:translate-x-[50%] duration-200 !rounded-none shadow"
            x-show="visible" x-transition:enter-start="!translate-x-[100%] md:!translate-x-[150%]"
            x-transition:enter-end="!translate-x-0 md:!translate-x-[50%]"
            x-transition:leave-start="!translate-x-0 md:!translate-x-[50%]"
            x-transition:leave-end="!translate-x-[100%] md:!translate-x-[150%]">
            content here - {{ $item->name }}
            <x-button class="ml-auto" x-on:click="visible = false">
                Fechar
            </x-button>
        </x-card>
    </x-modal>
</div>
