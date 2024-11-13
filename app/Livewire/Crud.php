<?php

namespace App\Livewire;

use App\Livewire\PaginatedList;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Blade;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;

#[Layout('layouts.application')]
class Crud extends PaginatedList
{
    public $icon;
    public $label;
    public $plural;
    public $title;
    public $createBtnText;
    public $model;
    public $limit = 12;
    public $search = "";
    public $createForm = '';
    public $editForm = '';
    public $createView = "livewire.crud.createView";
    public $sortBy = "updated_at";
    public $editingId = null;
    public $name = "";

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

    public function onCreated($created): void
    {
        // 
    }

    public function create(): void
    {
        $created = app()->make($this->model)->create($this->createPayload());
        $this->dispatch("closeCreateModal");
        $this->sortBy = "created_at";
        $this->search = "";
        $this->loadList();
        $this->dispatch('onNewMessage', [
            'type' => 'success',
            'text' => $this->label . 'successfully created !'
        ]);
        $this->onCreated($created);
    }

    public function makeCreateForm(): string
    {
        $label = strtolower($this->label);
        return <<<BLADE
            <x-input class="w-full" label="Name your $label" required model="name" />
        BLADE;
    }

    public function makeEditForm($entity): string
    {
        $this->name = $entity->name;
        $id = $entity->id;
        return <<<BLADE
            <x-inline-edit index="name" entityId="$id">
                <x-slot name="source">
                    <h1 class="text-2xl w-full font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        $this->name
                    </h1>
                </x-slot>
                <x-input class="w-full" required model="name" />
            </x-inline-edit>
        BLADE;
    }

    public function onSaveInline($index, $entityId): void
    {
        $entity = app()->make($this->model)->findOrFail($entityId);
        $entity->{$index} = $this->name;
        $entity->save();
        $this->editForm = $this->makeEditForm($entity);
        $this->dispatch('refreshCrudItem', $this->model, $entityId);
    }

    public function render(): View
    {
        $this->createForm = Blade::render($this->makeCreateForm());
        $this->editForm = Blade::render($this->editForm);
        return view('livewire.crud.index');
    }

    public function openEditModal($id)
    {
        $this->editForm = $this->makeEditForm(app()->make($this->model)->findOrFail($id));
        $this->editingId = $id;
    }
}
