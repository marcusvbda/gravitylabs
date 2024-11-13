<x-modal x-show="editModalVisible">
    <x-card x-cloak x-on:click.outside="editModalVisible = false"
        class="w-full md:w-1/2 h-full transition transform translate-x-0 md:translate-x-[50%] duration-200 !rounded-none shadow"
        x-show="editModalVisible" x-transition:enter-start="!translate-x-[100%] md:!translate-x-[150%]"
        x-transition:enter-end="!translate-x-0 md:!translate-x-[50%]"
        x-transition:leave-start="!translate-x-0 md:!translate-x-[50%]"
        x-transition:leave-end="!translate-x-[100%] md:!translate-x-[150%]">
        <template x-if="editModalVisible">
            <div class="w-full flex items-start flex-col gap-5 my-8" wire:loading.remove>
                {!! $this->editForm !!}
            </div>
            <div class="w-full py-8" wire:loading>
                <div class="flex items-center justify-center">
                    <x-spinner class="size-10" />
                </div>
            </div>
        </template>
    </x-card>
</x-modal>
