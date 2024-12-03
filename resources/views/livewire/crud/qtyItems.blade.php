<div class="text-lg flex items-center gap-2 text-gray-800 dark:text-white mb-6">
    @php
        $qty = $this->total;
        $total = $this->modelTotal;
    @endphp
    @if ($qty !== null)
        <div>
            {{ $qty }}
            {{ strtolower($qty === 0 ? $this->plural : ($qty > 1 ? $this->plural : $this->label)) }} found
            of
            <span x-cloak>{{ $total }}</span>
        </div>
    @else
        <div wire:loading>
            <x-spinner class="size-6 mb-2" />
        </div>
    @endif
</div>
