<div wire:init="loadList" x-data="crud">
    @section('shortcust')
        <x-sidebar :items="[
            'Quick links' => [
                'Applications' => 'app.applications.index',
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

    <x-modal x-show="createModalVisible" class="px-4 pt-10">
        <x-card x-cloak x-on:click.outside="createModalVisible = false" class="w-full md:w-1/2">
            <form class="flex flex-col gap-2 items-start" wire:submit.prevent="create">
                <h1
                    class="text-left w-full flex justify-between font-semibold items-center text-2xl text-gray-800 dark:text-white">
                    Create a new
                    {{ $this->label }}
                    <a href="#" x-on:click="createModalVisible = false" class="group cursor-pointer">
                        <x-icons.close class="size-6 opacity-50 transition-all duration-300 group-hover:opacity-100" />
                    </a>
                </h1>
                <div class="w-full flex flex-col gap-5 my-8">
                    <x-input class="w-full" label="Name your {{ $this->label }}" required model="newAppName" />
                    <x-input class="w-full" type="color" inputClass="h-10 py-1" label="Primary color" required
                        model="newAppPrimaryColor" />
                </div>
                <x-button type="submit">
                    Get started
                </x-button>
            </form>
        </x-card>
    </x-modal>

    <div class="text-lg flex items-center gap-2 text-gray-800 dark:text-white mt-6">
        @if (isset($this->items))
            @php
                $qty = $this->total;
            @endphp
            {{ $qty }} {{ $qty === 0 ? $this->plural : ($qty > 1 ? $this->plural : $this->label) }}
        @else
            Loading ...
        @endif
    </div>

    <div class="gap-4 mt-4 grid grid-cols-1 md:grid-cols-2">
        <x-input type="text" placeholder="Search..." inputClass="p-3" model="search" modelType="live.debounce.500ms">
            <x-slot name="append">
                @if (!$search)
                    <x-icons.search class="size-6" />
                @else
                    <a href="#" wire:click.prevent="resetSearch" class="group cursor-pointer">
                        <x-icons.close class="size-6 opacity-50 transition-all duration-300 group-hover:opacity-100" />
                    </a>
                @endif
            </x-slot>
        </x-input>
        <x-select inputClass="py-3" model="sortBy" modelType="live">
            <option value="updated_at">Sort by recently updated</option>
            <option value="created_at">Sort by recently created</option>
            <option value="name">Sort by name</option>
        </x-select>
    </div>

    <div class="w-full py-8">
        @if ($this->total === null)
            <div wire:loading class="w-full pt-8">
                <div class="flex items-center justify-center">
                    <x-spinner class="size-10" />
                </div>
            </div>
        @endif

        <div class="flex flex-col">
            @if ($this->total !== null)
                @if ($this->total <= 0)
                    <div class="w-full text-gray-400" wire:loading.remove>
                        <h4 class="text-2xl font-semibold">
                            No {{ $this->plural }} found
                        </h4>
                        <small class="text-xs">
                            Try broadening your filter or create a new one
                        </small>
                    </div>
                @else
                    <div class="w-full gap-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3">
                        @foreach ($this->items as $item)
                            <x-entity-item name="{{ $item->name }}" code="{{ $item->code }}"
                                color="{{ $item->primary_color }}"
                                description="{{ 'Last updated at ' . $item->updated_at->format('M d, Y') }}" />
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
                @endif
            @endif
        </div>
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
