<button type="button" wire:click="toggleTheme"
    class="relative cursor-pointer rounded-full dark:bg-gray-800 p-1 text-gray-400 hover:text-gray-500 dark:hover:text-white focus:outline-none">
    <span class="absolute -inset-1.5"></span>
    <span class="sr-only">Theme switcher</span>
    @if ($theme == 'dark')
        <svg class="size-6" viewBox="0 0 24 24" fill="none">
            <path
                d="M12 5V3M12 21V19M7.05 7.05L5.636 5.636M18.364 18.364L16.95 16.95M5 12H3M21 12H19M7.05 16.95L5.636 18.364M18.364 5.636L16.95 7.05M16 12C16 14.2091 14.2091 16 12 16C9.79086 16 8 14.2091 8 12C8 9.79086 9.79086 8 12 8C14.2091 8 16 9.79086 16 12Z"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
    @else
        <svg class="size-6" viewBox="0 0 24 24" fill="none">
            <path
                d="M12 21C7.02944 21 3 16.9706 3 12C3 7.19723 6.76201 3.27311 11.5 3.01367V3C11.1456 3.96621 11 4.91097 11 6.00002C11 10.9706 15.0294 15 20 15C20.2387 15 20.2539 15.0183 20.4879 15C19.2524 18.4956 15.9187 21 12 21Z"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
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
