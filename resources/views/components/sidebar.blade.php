<div class="w-full py-1 px-4 md:p-4 overflow-x-auto no-scrollbar">
    <ul class="list-unstyled flex flex-row md:flex-col gap-4">
        <li>
            @foreach ($items as $key => $rows)
                <h5 class="mb-1 text-gray-500 text-xs uppercase dark:text-gray-400 hidden md:block">
                    {{ $key }}
                </h5>
                <ul class="pb-1 list-unstyled fw-normal small flex gap-6 md:gap-0 flex-row md:flex-col pr-4">
                    @foreach ($rows as $itemKey => $itemValue)
                        <li>
                            <a href="{{ route($itemValue) }}"
                                style="color : {{ request()->routeIs($itemValue) ? 'var(--theme-color)' : '' }}"
                                wire:navigate
                                class="duration-200 relative flex items-center flex-wrap font-medium  text-gray-500">
                                {{ $itemKey }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endforeach
        </li>
    </ul>
</div>
