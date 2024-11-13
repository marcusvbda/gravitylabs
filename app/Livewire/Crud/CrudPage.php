<?php

namespace App\Livewire\Crud;

use App\Livewire\PaginatedList;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;

#[Layout('layouts.application')]
class CrudPage extends PaginatedList
{
    public $icon;
    public $label;
    public $plural;
    public $title;
    public $createBtnText;
    public $model;
    public $limit = 12;
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

    public function makeQuery(): mixed
    {
        return app()->make($this->model)
            ->where('name', 'like', "%{$this->search}%")
            ->orderBy($this->sortBy, $this->sortBy === "name" ? 'asc' : 'desc');
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
