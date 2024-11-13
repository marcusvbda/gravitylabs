<div wire:init="loadList" x-data="crud">
    @section('shortcust')
        <x-sidebar :items="[
            'Quick links' => [
                'Applications' => 'app.applications.index',
                'Test' => 'app.test',
            ],
        ]" />
    @endsection

    <h4 wire:ignore
        class="text-3xl flex items-center gap-2 text-gray-800 dark:text-white border-b border-gray-200 dark:border-gray-700 pb-6">
        {!! Blade::render("<x-$this->icon />") !!}
        {!! $this->title !!}
        <x-button class="ml-auto" x-on:click="createModalVisible = true">
            {!! $this->createBtnText !!}
        </x-button>
    </h4>

    @include('livewire/crud/headerFilter')

    <div class="w-full py-8">
        @if ($this->total === null)
            <div wire:loading class="w-full pt-8">
                <div class="flex items-center justify-center">
                    <x-spinner class="size-10" />
                </div>
            </div>
        @endif
        @include('livewire/crud/listItems')
        @include('livewire/crud/modalCreate')
    </div>
</div>
@script
    <script>
        Alpine.data('crud', () => ({
            createModalVisible: false,
            init() {
                Livewire.on('closeCreateModal', () => {
                    this.createModalVisible = false
                })
            }
        }))
    </script>
@endscript
