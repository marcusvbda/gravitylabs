<?php

namespace App\Livewire;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;
use Livewire\Component;

class Messages extends Component
{
    public $messages = [];
    public $timeout = 5000;
    public $colors = [
        'success' =>
        'text-green-800 border-green-300 bg-green-50 dark:text-green-400 dark:border-green-800',
        'info' => 'text-blue-800 bg-blue-50 dark:text-blue-400',
        'error' => 'text-red-800 bg-red-50 dark:text-red-400',
        'warning' => 'text-yellow-800 bg-yellow-50 dark:text-yellow-300',
    ];

    #[On('onNewMessage')]
    public function onNewMessageHandler($data): void
    {
        $uid = uniqid();
        $this->messages[] = ["uid" => $uid, ...$data];
        $this->dispatch("removeIn5Seconds", $uid);
    }

    public function removeMessage($id): void
    {
        $this->messages = array_filter($this->messages, fn($message) => $message["uid"] !== $id);
    }


    public function render(): View
    {
        return view('livewire.messages');
    }
}
