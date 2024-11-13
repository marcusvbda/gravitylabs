<x-modal x-show="createModalVisible" class="px-4 pt-10">
    <x-card x-cloak x-on:click.outside="createModalVisible = false" class="w-full md:w-1/2">
        <form class="flex flex-col gap-2 items-start" wire:submit.prevent="create">
            <h1
                class="text-left w-full flex justify-between font-semibold items-center text-2xl text-gray-800 dark:text-white">
                Create a new
                {{ strtolower($this->label) }}
                <a href="#" x-on:click="createModalVisible = false" class="group cursor-pointer">
                    <x-icons.close class="size-6 opacity-50 transition-all duration-300 group-hover:opacity-100" />
                </a>
            </h1>
            <div class="w-full flex flex-col gap-5 my-8">
                <x-input class="w-full" label="Name your {{ strtolower($this->label) }}" required model="newAppName" />
                <x-input class="w-full" type="color" inputClass="h-10 py-1" label="Primary color" required
                    model="newAppPrimaryColor" />
            </div>
            <x-button type="submit">
                Get started
            </x-button>
        </form>
    </x-card>
</x-modal>
