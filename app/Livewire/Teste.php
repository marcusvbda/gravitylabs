<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Auth;

#[Layout('layouts.application')]
#[Title('Teste')]
class Teste extends Component
{

    public function render(): mixed
    {
        $this->user = Auth::user();
        $selected = @$this->user->settings->selected_app;
        return <<<BLADE
            <h1>This is a test {{$selected}}</h1>
        BLADE;
    }
}
