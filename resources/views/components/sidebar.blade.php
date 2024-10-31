<div class="w-full py-1 px-4 md:p-4 overflow-x-auto no-scrollbar">
    <ul class="list-unstyled flex flex-row md:flex-col gap-4">
        <li>
            @foreach ($items as $key => $rows)
                <h5 class="mb-2 font-semibold text-gray-900 uppercase dark:text-white hidden md:block">
                    {{ $key }}
                </h5>
                <ul class="py-1 list-unstyled fw-normal small flex gap-6 md:gap-0 flex-row md:flex-col pr-4">
                    @foreach ($rows as $itemKey => $itemValue)
                        <li>
                            <a href="{{ route($itemValue) }}"
                                class="py-2 md:pb-0 duration-200 relative flex items-center flex-wrap font-medium hover:text-gray-900 text-gray-500 dark:text-gray-400 dark:hover:text-white {{ request()->routeIs($itemValue) ? '!text-primary-600' : '' }}">
                                {{ $itemKey }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            @endforeach
        </li>
    </ul>
</div>
