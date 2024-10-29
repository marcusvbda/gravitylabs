<div class="relative flex text-sm">
    <span class="absolute -inset-1.5"></span>
    <span class="sr-only">Open user menu</span>
    <div
        class="size-{{ $size ?? '8' }} overflow-hidden rounded-full bg-gray-300 dark:bg-gray-900 text-white dark:text-gray-300 text-xl font-bold flex items-center justify-center">
        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
    </div>
</div>
