<div>
    @if (@$selectedApp)
        <x-dropdown-menu class="ml-3" contentClass="max-h-[600px] w-[300px] overflow-y-auto">
            <x-slot name="source">
                <div wire:init="loadList"
                    class="rounded-md bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-white px-3 py-2 text-sm font-medium flex items-center gap-2"
                    aria-current="page">
                    {{ $selectedApp->name }}
                    <div class="ml-2" wire:loading>
                        <x-spinner class="size-4" />
                    </div>
                    <x-icons.arrow-down class="size-3" />
                </div>
            </x-slot>
            <x-slot name="content">
                <div wire:loading.remove>
                    @if (@$this->total)
                        @foreach ($this->items as $item)
                            <a href="#" wire:click.prevent="selectApp({{ $item->id }})"
                                class="flex px-4 py-2 text-sm text-gray-400 cursor-pointer dark:text-gray-500 items-center justify-between gap-2 hover:text-gray-900 dark:hover:text-white transition duration-300"
                                role="menuitem" tabindex="-1">
                                {{ $item->name }} <x-icons.arrow-down class="size-3 -rotate-90" />
                            </a>
                        @endforeach
                        @if ($this->hasMorePages)
                            <div href="#" wire:loading.remove wire:click.prevent="loadMore"
                                class="px-4 py-2 text-sm text-gray-700 dark:text-gray-200 flex cursor-pointer items-center justify-center gap-2"
                                role="menuitem" tabindex="-1">
                                Load more
                                <x-icons.arrow-down class="size-3" />
                            </div>
                            <div class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200" role="menuitem"
                                tabindex="-1">
                                <div class="w-full" wire:loading>
                                    <div class="flex items-center justify-center">
                                        <x-spinner class="size-6" />
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                </div>
            </x-slot>
        </x-dropdown-menu>
    @endif
</div>
