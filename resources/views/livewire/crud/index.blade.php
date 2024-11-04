<div>
    @section('shortcust')
        <x-sidebar :items="[
            'Quick links' => [
                'My apps' => 'app.applications.index',
                // 'login' => 'auth.login',
            ],
        ]" />
    @endsection

    <h4 wire:ignore
        class="text-3xl flex items-center gap-2 text-gray-800 dark:text-white border-b border-gray-200 dark:border-gray-700 pb-6">
        {!! Blade::render("<x-$this->icon />") !!}
        {!! $this->title !!}
        <x-button class="ml-auto">
            {!! $this->createBtnText !!}
        </x-button>
    </h4>

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

    <div class="w-full py-8" wire:init="loadList">
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
