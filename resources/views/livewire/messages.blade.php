<div class="w-full flex flex-col gap-2 {{ count($this->messages) > 0 ? 'mb-10' : '' }}">
    @foreach ($this->messages as $message)
        <div id="alert-1" class="flex items-center p-4 rounded-lg {{ $this->colors[data_get($message, 'type')] }}"
            role="alert" wire:transition wire:key="{{ data_get($message, 'uid') }}"
            wire:mouseover="dispatch('stopTimer','{{ data_get($message, 'uid') }}')"
            wire:mouseout="dispatch('restartTimer','{{ data_get($message, 'uid') }}')">
            <x-icons.info />
            <span class="sr-only">Info</span>
            <div class="ms-3 text-sm font-medium">
                {!! data_get($message, 'text') !!}
            </div>
            <button type="button" wire:click="removeMessage('{{ data_get($message, 'uid') }}')"
                class="ms-auto -mx-1.5 -my-1.5 rounded-lg focus:ring-2p-1.5 inline-flex items-center justify-center h-8 w-8 {{ $this->colors[data_get($message, 'type')] }}"
                data-dismiss-target="#alert-1" aria-label="Close">
                <span class="sr-only">Close</span>
                <x-icons.close class="size-3" />
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
            }, {{ $this->timeout }})
        });

        $wire.on('stopTimer', (uid) => {
            clearTimeout(alertTimes[uid])
        });

        $wire.on('restartTimer', (uid) => {
            alertTimes[uid] = setTimeout(() => {
                $wire.removeMessage(uid)
            }, {{ $this->timeout }} / 2)
        });
    </script>
@endscript
