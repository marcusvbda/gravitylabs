<?php

namespace App\Livewire\Crud;

use Illuminate\Contracts\View\View;
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


    public function updated($field): void
    {
        if (in_array($field, ["search", "sortBy"])) {
            $this->loadList();
        }
    }

    public function resetSearch(): void
    {
        $this->search = "";
        $this->loadList();
    }

    public function loadList($skip = 0): void
    {
        $query = app()->make($this->model)
            ->where('name', 'like', "%{$this->search}%")
            ->orderBy($this->sortBy, $this->sortBy === "name" ? 'asc' : 'desc');

        $this->total = $query->count();
        $query = $query->take($this->limit)->skip($skip);
        $this->items = !$skip ?  $query->get() : $this->items->toBase()->merge($query->get());
        $this->hasMorePages = $this->items->count() < $this->total;
    }

    public function loadMore(): void
    {
        $this->loadList($this->items->count());
    }

    public function render(): View
    {
        return view('livewire.crud.index');
    }
}
