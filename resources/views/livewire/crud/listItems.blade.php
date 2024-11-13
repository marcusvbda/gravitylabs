<div class="flex flex-col" x-data="{ editModalVisible: false }">
    @if ($this->total !== null)
        @if ($this->total <= 0)
            <div class="w-full text-gray-400" wire:loading.remove>
                <h4 class="text-2xl font-semibold">
                    No {{ strtolower($this->label) }} found
                </h4>
                <small class="text-xs">
                    Try broadening your filter or create a new one
                </small>
            </div>
        @else
            <div class="w-full gap-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($this->items as $item)
                    <div wire:click="openEditModal({{ $item->id }})" x-on:click="editModalVisible = true"
                        wire:key="div_crud_item_component_{{ $item->id }}">
                        <livewire:crud-item :item="$item" wire:key="crud_item_component_{{ $item->id }}" />
                    </div>
                @endforeach
            </div>
            @if ($this->hasMorePages)
                <div class="w-full py-10 flex items-center justify-center">
                    <a href="#"
                        class="flex items-center gap-2 text-gray-700 cursor-pointer dark:text-gray-400 text-sm"
                        wire:loading.remove wire:click.prevent="loadMore">
                        Load more
                        <x-icons.arrow-down class="size-3" />
                    </a>
                    <div wire:loading class="w-full">
                        <div class="flex items-center justify-center">
                            <x-spinner class="size-10" />
                        </div>
                    </div>
                </div>
            @endif
            @include('livewire.crud.modalEdit')
        @endif
    @endif
</div>
