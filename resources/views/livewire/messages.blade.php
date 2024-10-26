<div class="w-full flex flex-col gap-2 {{ count($this->messages) > 0 ? 'mb-10' : '' }}">
    @foreach ($this->messages as $message)
        <div id="alert-1" class="flex items-center p-4 rounded-lg {{ $colors[data_get($message, 'type')] }}"
            role="alert" wire:transition wire:key="{{ data_get($message, 'uid') }}"
            wire:mouseover="dispatch('stopTimer','{{ data_get($message, 'uid') }}')"
            wire:mouseout="dispatch('restartTimer','{{ data_get($message, 'uid') }}')">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div class="ms-3 text-sm font-medium">
                {!! data_get($message, 'title') !!}
            </div>
            <button type="button" wire:click="removeMessage('{{ data_get($message, 'uid') }}')"
                class="ms-auto -mx-1.5 -my-1.5 rounded-lg focus:ring-2p-1.5 inline-flex items-center justify-center h-8 w-8 {{ $colors[data_get($message, 'type')] }} dark:hover:bg-gray-700"
                data-dismiss-target="#alert-1" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    @endforeach
</div>
@script
    <script>
        let alertTimes = {}
        $wire.on('removeIn5Seconds', (params) => {
            alertTimes[params[0]] = setTimeout(() => {
                $wire.removeMessage(params[0])
            }, {{ $timeout }})
        });

        $wire.on('stopTimer', (uid) => {
            clearTimeout(alertTimes[uid])
        });

        $wire.on('restartTimer', (uid) => {
            alertTimes[uid] = setTimeout(() => {
                $wire.removeMessage(uid)
            }, {{ $timeout }} / 2)
        });
    </script>
@endscript
