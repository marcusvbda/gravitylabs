<div x-data="{ visible: false }" style="--theme-color: {{ $color }}">
    <div class="p-2 dark:bg-gray-800 rounded-3xl flex items-center group cursor-pointer"
        style="background-color: {{ $color . '17' }}" data-code="{{ $code }}" x-on:click="visible = true">
        <div class="size-14 min-w-14 rounded-2xl flex items-center justify-center text-white text-2xl font-bold"
            style="background-color: var(--theme-color)">
            {{ substr($name, 0, 1) }}
        </div>
        <div class="flex-1 flex flex-col gap-2 px-4 overflow-hidden">
            <h4 class="font-bold text-base truncate" style="color: var(--theme-color)">
                {{ $name }}
            </h4>
            <small class="text-gray-500 text-xs">
                {{ $description }}
            </small>
        </div>
        <div class="text-gray-700 group-hover:text-[var(--theme-color)] transition duration-200">
            <x-icons.entity-item />
        </div>
    </div>
    <x-modal x-show="visible">
        <x-card x-cloak x-on:click.outside="visible = false"
            class="w-full md:w-1/2 h-full transition duration-200 transform translate-x-0  md:translate-x-[50%] !rounded-none shadow"
            x-show="visible" x-transition:enter-start="transform translate-x-[100%] md:translate-x-[150%] opacity-0"
            x-transition:enter-end="transform translate-x-0 md:translate-x-[50%] opacity-100"
            x-transition:leave-start="transform translate-x-0 md:translate-x-[50%] opacity-100"
            x-transition:leave-end="transform translate-x-[100%] md:translate-x-[150%] opacity-0">
            content here - {{ $name }}
            <x-button class="ml-auto" x-on:click="visible = false">
                Fechar
            </x-button>
        </x-card>
    </x-modal>
</div>
