<div class="gap-4 mt-4 grid grid-cols-1 md:grid-cols-6">
    <div class="col-span-1 md:col-span-4">
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
    </div>
    <div class="cols-span-1 md:col-span-2">
        <x-select inputClass="py-3" model="sortBy" modelType="live">
            <option value="updated_at">Sort by recently updated</option>
            <option value="created_at">Sort by recently created</option>
            <option value="name">Sort by name</option>
        </x-select>
    </div>
</div>
