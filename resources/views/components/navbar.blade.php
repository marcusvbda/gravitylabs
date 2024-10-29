<nav class="bg-white border-b border-gray-200 dark:border-gray-700 dark:bg-gray-800" x-data="{ menuMobileOpened: false, profileDropdownOpened: false }">
    <div class="px-2 sm:px-6 lg:px-8">
        <div class="relative flex h-16 items-center justify-between">
            <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                <button type="button" x-on:click="menuMobileOpened = !menuMobileOpened"
                    class="relative inline-flex items-center justify-center rounded-md p-2 text-gray-400"
                    aria-controls="mobile-menu" :aria-expanded="menuMobileOpened.toString()">
                    <span class="absolute -inset-0.5"></span>
                    <span class="sr-only" x-text="menuMobileOpened ? 'Close main menu' : 'Open main menu'"></span>
                    <template x-if="!menuMobileOpened">
                        <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            aria-hidden="true" data-slot="icon">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        </svg>
                    </template>
                    <template x-if="menuMobileOpened">
                        <svg class="size-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                            aria-hidden="true" data-slot="icon">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </template>
                </button>
            </div>
            <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
                <a href="{{ route('app.applications.index') }}" class="flex flex-shrink-0 items-center cursor-pointer">
                    <img class="h-8 w-auto" src="{{ config('app.logo') }}" alt="{{ config('app.name') }}}">
                </a>
                <div class="hidden sm:ml-6 sm:block">
                    <div class="flex space-x-4">
                        @foreach ($items as $key => $value)
                            <a href="{{ route($value) }}"
                                class="rounded-md {{ request()->routeIs($value) ? 'bg-gray-100 text-gray-800 dark:bg-gray-900 dark:text-white' : 'text-gray-800 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 hover:text-gray-800 dark:hover:text-white' }} px-3 py-2 text-sm font-medium "
                                aria-current="page">
                                {{ $key }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                @livewire('template.theme-switcher')
                <x-dropdown-menu class="ml-3">
                    <x-slot name="source">
                        <x-avatar size="8"></x-avatar>
                    </x-slot>
                    <x-slot name="content">
                        <div class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200" role="menuitem"
                            tabindex="-1" id="user-menu-item-0">
                            <strong>
                                {{ Auth::user()->email }}
                            </strong>
                        </div>
                        <a href="{{ route('auth.logout') }}"
                            class="block px-4 py-2 text-sm text-gray-700 dark:text-gray-200" role="menuitem"
                            tabindex="-1" id="user-menu-item-2">Sign out</a>
                    </x-slot>
                </x-dropdown-menu>
            </div>
        </div>
    </div>

    <div class="sm:hidden" x-show="menuMobileOpened" x-on:click.stop.outside="menuMobileOpened = false" x-cloak
        x-transition>
        <div class="space-y-1 px-2 pb-3 pt-2">
            @foreach ($items as $key => $value)
                <a href="{{ route($value) }}"
                    class="{{ !request()->routeIs($value) ? 'bg-gray-100 dark:bg-gray-900 text-gray-800 dark:text-white' : 'text-gray-800 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 dark:hover:text-white' }} block rounded-md px-3 py-2 text-base font-medium text-gray-300"
                    aria-current="page">
                    {{ $key }}
                </a>
            @endforeach
        </div>
    </div>
</nav>
