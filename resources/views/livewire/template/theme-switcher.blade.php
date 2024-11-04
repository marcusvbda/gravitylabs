<button type="button" wire:click="toggleTheme"
    class="relative cursor-pointer rounded-full dark:bg-gray-800 p-1 text-gray-400 hover:text-gray-500 dark:hover:text-white focus:outline-none">
    <span class="absolute -inset-1.5"></span>
    <span class="sr-only">Theme switcher</span>
    @if ($this->theme == 'dark')
        <x-icons.light class="size-6" />
    @else
        <x-icons.dark class="size-6" />
    @endif
</button>

@script
    <script>
        $wire.on('theme-changed', (val) => {
            const el = document.documentElement;
            el.classList.remove(...el.classList);
            el.classList.add(val[0]);
        });
    </script>
@endscript
