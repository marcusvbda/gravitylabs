<form class="space-y-4 md:space-y-6" wire:submit="submit">
    <x-input label="Your Email" type="email" required placeholder="name@company.com" model="email" />
    <x-input label="Password" type="password" required placeholder="••••••••" model="password" />
    <div class="flex items-center justify-between">
        <x-checkbox label="Remember me" />
        {{-- <x-link href="#">Forgot password?</x-link> --}}
    </div>
    <x-button class="w-full" type="submit">
        Sign in
    </x-button>
    {{-- <p class="text-sm font-light text-gray-500 dark:text-gray-400">
        Don’t have an account yet? <x-link href="#">Sign up</x-link>
    </p> --}}
</form>
