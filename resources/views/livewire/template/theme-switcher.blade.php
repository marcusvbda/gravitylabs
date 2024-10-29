<button type="button" wire:click="toggleTheme"
    class="relative cursor-pointer rounded-full bg-gray-800 p-1 text-gray-400 hover:text-white focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-gray-800">
    <span class="absolute -inset-1.5"></span>
    <span class="sr-only">Theme switcher</span>
    @if ($theme == 'dark')
        <svg class="size-6" viewBox="0 0 24 24" fill="none">
            <g stroke="currentColor" stroke-width="1.5" stroke-miterlimit="10">
                <path
                    d="M5 12H1M23 12h-4M7.05 7.05 4.222 4.222M19.778 19.778 16.95 16.95M7.05 16.95l-2.828 2.828M19.778 4.222 16.95 7.05"
                    stroke-linecap="round" />
                <path d="M12 16a4 4 0 1 0 0-8 4 4 0 0 0 0 8Z" fill="currentColor" fill-opacity=".16" />
                <path d="M12 19v4M12 1v4" stroke-linecap="round" />
            </g>
            <defs>
                <clipPath id="a">
                    <path fill="currentColor" d="M0 0h24v24H0z" />
                </clipPath>
            </defs>

        </svg>
    @else
        <svg class="size-6" viewBox="0 0 24 24" fill="none">
            <g clip-path="url(#clip0_429_11017)">
                <path
                    d="M20.9955 11.7115L22.2448 11.6721C22.2326 11.2847 22.0414 10.9249 21.7272 10.698C21.413 10.4711 21.0113 10.4029 20.6397 10.5132L20.9955 11.7115ZM12.2885 3.00454L13.4868 3.36028C13.5971 2.98873 13.5289 2.58703 13.302 2.2728C13.0751 1.95857 12.7153 1.76736 12.3279 1.75516L12.2885 3.00454ZM20.6397 10.5132C20.1216 10.667 19.5716 10.75 19 10.75V13.25C19.815 13.25 20.6046 13.1314 21.3512 12.9098L20.6397 10.5132ZM19 10.75C15.8244 10.75 13.25 8.17564 13.25 5H10.75C10.75 9.55635 14.4437 13.25 19 13.25V10.75ZM13.25 5C13.25 4.42841 13.333 3.87841 13.4868 3.36028L11.0902 2.64879C10.8686 3.39542 10.75 4.18496 10.75 5H13.25ZM12 4.25C12.0834 4.25 12.1665 4.25131 12.2492 4.25392L12.3279 1.75516C12.219 1.75173 12.1097 1.75 12 1.75V4.25ZM4.25 12C4.25 7.71979 7.71979 4.25 12 4.25V1.75C6.33908 1.75 1.75 6.33908 1.75 12H4.25ZM12 19.75C7.71979 19.75 4.25 16.2802 4.25 12H1.75C1.75 17.6609 6.33908 22.25 12 22.25V19.75ZM19.75 12C19.75 16.2802 16.2802 19.75 12 19.75V22.25C17.6609 22.25 22.25 17.6609 22.25 12H19.75ZM19.7461 11.7508C19.7487 11.8335 19.75 11.9166 19.75 12H22.25C22.25 11.8903 22.2483 11.781 22.2448 11.6721L19.7461 11.7508Z"
                    fill="currentColor" />
            </g>
            <defs>
                <clipPath id="clip0_429_11017">
                    <rect width="24" height="24" fill="white" />
                </clipPath>
            </defs>
        </svg>
    @endif
</button>
