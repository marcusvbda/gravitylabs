<?php

namespace App\Livewire\Crud;

use Livewire\Component;

class Index extends Component
{
    public $qty = 0;
    public $icon;
    public $label;
    public $plural;
    public $title;
    public $createBtnText;
    public $search = "";
    public $sortBy = "updated_at";

    public function updated($field)
    {
        if (in_array($field, ["search", "sortBy"])) {
            $this->triggerAction();
        }
    }

    public function triggerAction()
    {
        sleep(1);
        // dd($this->search, $this->sortBy);
    }

    public function render()
    {
        return view('livewire.crud.index');
    }
}
