<?php

namespace App\Livewire\Crud;

use App\Models\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.application')]
class CrudPage extends Component
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

    public function __construct()
    {
        $this->model = Application::class;
    }

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

    public function createPayload(): array
    {
        return [];
    }

    public function onCreated(): void
    {
        // 
    }


    public function create(): void
    {
        app()->make($this->model)->create($this->createPayload());
        $this->dispatch("closeCreateModal");
        $this->sortBy = "created_at";
        $this->search = "";
        $this->loadList();
        $this->dispatch('onNewMessage', [
            'type' => 'success',
            'text' => $this->label . 'successfully created !'
        ]);
        $this->onCreated();
    }


    public function render(): View
    {
        return view('livewire.crud.index');
    }
}
