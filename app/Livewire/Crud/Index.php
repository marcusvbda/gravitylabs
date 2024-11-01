<?php

namespace App\Livewire\Crud;

use Livewire\Component;
use Livewire\Attributes\Computed;

class Index extends Component
{
    public $qty = 0;
    public $icon;
    public $label;
    public $plural;
    public $title;
    public $createBtnText;
    // public $total = 0;
    public $total = 24;
    public $perPage = 10;
    public $listCount = 10;
    public $search = "";
    public $sortBy = "updated_at";

    // public function mount()
    // {
    //     $this->listCount = $this->perPage;
    // }

    public function updated($field)
    {
        if (in_array($field, ["search", "sortBy"])) {
            $this->triggerAction();
        }
    }

    // #[Computed]
    // public function listCount()
    // {
    //     // 
    // }

    #[Computed]
    public function hasMoreItems()
    {
        return $this->listCount < $this->total;
    }

    public function triggerAction()
    {
        sleep(1);
        $this->listCount = $this->perPage;
    }

    public function loadMore()
    {
        sleep(1);
        $this->listCount += $this->perPage;
    }

    public function render()
    {
        return view('livewire.crud.index');
    }
}
