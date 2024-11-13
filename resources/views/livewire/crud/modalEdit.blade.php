<x-modal x-show="editModalVisible">
    <x-card x-cloak x-on:click.outside="editModalVisible = false"
        class="w-full md:w-1/2 h-full transition transform translate-x-0 md:translate-x-[50%] duration-200 !rounded-none shadow"
        x-show="editModalVisible" x-transition:enter-start="!translate-x-[100%] md:!translate-x-[150%]"
        x-transition:enter-end="!translate-x-0 md:!translate-x-[50%]"
        x-transition:leave-start="!translate-x-0 md:!translate-x-[50%]"
        x-transition:leave-end="!translate-x-[100%] md:!translate-x-[150%]">
        <div class="text-left w-full flex justify-between font-semibold items-start text-2xl">
            <div class="size-24 min-w-24 rounded-xl flex items-center justify-center text-white text-5xl font-bold"
                style="background-color: var(--theme-color)">
                {{ strtoupper(substr($item->name, 0, 1)) }}
            </div>
            <a href="#" x-on:click="editModalVisible = false" class="group cursor-pointer">
                <x-icons.close
                    class="size-10 opacity-50 transition-all duration-300 group-hover:opacity-100 text-gray-800 dark:text-white" />
            </a>
        </div>
        <template x-if="editModalVisible">
            <div class="w-full flex items-start flex-col gap-5 my-8">
                @if (!$this->editingId)
                    <div class="w-full pt-8">
                        <div class="flex items-center justify-center">
                            <x-spinner class="size-10" />
                        </div>
                    </div>
                @else
                    {!! $this->editForm !!}
                @endif
            </div>
        </template>
    </x-card>
</x-modal>
