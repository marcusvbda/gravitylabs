<footer class="bg-white dark:bg-gray-800" x-data>
    <div class="p-4 md:p-6 lg:p-8">
        <div class="md:flex md:justify-between">
            <div class="mb-6 md:mb-0">
                <a href="{{ route('app.applications.index') }}" class="flex items-center">
                    <img src="{{ config('app.logo') }}" class="h-8 me-3" alt="FlowBite Logo" />
                    <span
                        class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">{{ config('app.name') }}
                    </span>
                </a>
            </div>
            <div class="grid grid-cols-2 gap-8 sm:gap-6 sm:grid-cols-3">
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Resources</h2>
                    <ul class="text-gray-500 dark:text-gray-400 font-medium">
                        <li class="mb-4">
                            <a href="{{ route('app.applications.index') }}" class="hover:underline">
                                {{ config('app.name') }}
                            </a>
                        </li>
                    </ul>
                </div>
                <div>
                    <h2 class="mb-6 text-sm font-semibold text-gray-900 uppercase dark:text-white">Follow us</h2>
                    <ul class="text-gray-500 dark:text-gray-400 font-medium">
                        <li class="mb-4">
                            <a href="https://github.com/marcusvbda" target="_blank" class="hover:underline ">Github</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
        <div class="sm:flex sm:items-center sm:justify-between">
            <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© <span
                    x-text="new Date().getFullYear()"></span> <a href="{{ route('app.applications.index') }}"
                    class="hover:underline">{{ config('app.name') }}™</a>. All Rights Reserved.
            </span>
            <div class="flex mt-4 sm:justify-center sm:mt-0">
                <a href="#" class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
                    <a href="https://github.com/marcusvbda" target="_blank"
                        class="text-gray-500 hover:text-gray-900 dark:hover:text-white ms-5">
                        <x-icons.github />
                        <span class="sr-only">GitHub account</span>
                    </a>
            </div>
        </div>
    </div>
</footer>
