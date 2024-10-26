<?php

namespace App\Livewire;

use Livewire\Component;

class Counter extends Component
{
    public $count = 0;

    public function __construct($initial = 1)
    {
        $this->count = $initial;
    }

    public function increment()
    {
        $this->count++;
    }

    public function decrement()
    {
        // $this->count--;
        $this->dispatch('onNewMessage', ['type' => 'info', 'title' => 'cool message!', 'text' => 'lorem ipsum']);
        // $this->dispatch('onNewMessage', ['type' => 'warning', 'title' => 'cool message!', 'text' => 'lorem ipsum']);
        // $this->dispatch('onNewMessage', ['type' => 'error', 'title' => 'cool message!', 'text' => 'lorem ipsum']);
        // $this->dispatch('onNewMessage', ['type' => 'success', 'title' => 'cool message!', 'text' => 'lorem ipsum']);
    }

    public function render()
    {
        return <<<BLADE
            <div>
                <h1>$this->count</h1>
                <button type="button" wire:click="increment">+</button>
                <button type="button" wire:click="decrement">-</button>
            </div>
        BLADE;
    }
}
