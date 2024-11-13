<div class="w-full" x-data="{ showing: false }">
    <template x-if="!showing">
        <div class="w-full flex items-center justify-between">
            {{ $source }}
            <a href="#" @click.prevent="showing = true" class="ml-auto">
                <x-icons.edit class="size-6 text-[var(--theme-color)]" />
            </a>
        </div>
    </template>
    <template x-if="showing">
        <div class="w-full" wire:click.away="onSaveInline('{{ $index }}', {{ $entityId }}); showing = false">
            {{ $slot }}
        </div>
    </template>
</div>