<div class="relative {{ $class ?? '' }}" x-data="{ opened: false }">
    <div x-on:click="opened = !opened" class="cursor-pointer">
        {{ $source }}
    </div>
    @if (@$content)
        <div class="absolute right-0 z-10 mt-2 w-48 origin-top-right rounded-md dark:bg-gray-900 bg-white py-1 shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none {{ @$contentClass }}"
            role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1" x-show="opened"
            x-on:click.outside="opened = false" x-cloak x-transition>
            {{ @$content }}
        </div>
    @endif
</div>
