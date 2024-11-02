<?php

namespace App\Livewire\Crud;

use Illuminate\Support\Collection;
use Livewire\Component;


class Index extends Component
{
    public $icon;
    public $label;
    public $plural;
    public $title;
    public $createBtnText;
    public $model;
    public Collection $items;
    public $total = null;
    public $limit = 12;
    public $hasMorePages = false;
    public $search = "";
    public $sortBy = "updated_at";


    public function updated($field)
    {
        if (in_array($field, ["search", "sortBy"])) {
            $this->loadList();
        }
    }

    public function resetSearch()
    {
        $this->search = "";
        $this->loadList();
    }

    public function loadList($skip = 0)
    {
        $query = app()->make($this->model)
            ->where('name', 'like', "%{$this->search}%")
            ->orderBy($this->sortBy, 'desc');

        $this->total = $query->count();
        $query = $query->take($this->limit)->skip($skip);
        $this->items = !$skip ?  $query->get() : $this->items->toBase()->merge($query->get());
        $this->hasMorePages = $this->items->count() < $this->total;
    }

    public function loadMore()
    {
        $this->loadList($this->items->count());
    }

    public function render()
    {
        return view('livewire.crud.index');
    }
}
