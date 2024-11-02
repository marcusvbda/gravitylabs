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
        {!! $this->icon !!}
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
                    <svg class="size-6" viewBox="0 0 24 24" fill="none">
                        <path
                            d="M21 21L17.5 17.5M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" />
                    </svg>
                @else
                    <a href="#" wire:click.prevent="resetSearch" class="group cursor-pointer">
                        <svg class="size-6 opacity-50 transition-all duration-300 group-hover:opacity-100"
                            viewBox="0 0 24 24" fill="none">
                            <path fill-rule="evenodd" clip-rule="evenodd"
                                d="M18.6454 5.29112C19.0369 5.68067 19.0384 6.31383 18.6489 6.70533L13.4107 11.9699L18.7089 17.2947C19.0984 17.6862 19.0968 18.3193 18.7053 18.7089C18.3138 19.0984 17.6807 19.0968 17.2911 18.7053L12 13.3876L6.70888 18.7053C6.31933 19.0968 5.68617 19.0984 5.29467 18.7089C4.90317 18.3193 4.90158 17.6862 5.29112 17.2947L10.5893 11.9699L5.3511 6.70534C4.96156 6.31384 4.96314 5.68067 5.35465 5.29113C5.74615 4.90158 6.37931 4.90317 6.76886 5.29467L12 10.5521L17.2311 5.29467C17.6207 4.90317 18.2539 4.90158 18.6454 5.29112Z"
                                fill="currentColor" />
                        </svg>
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
                                <svg class="size-4" viewBox="0 0 24 24" fill="none">
                                    <path d="M8 10L12 14L16 10" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
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
