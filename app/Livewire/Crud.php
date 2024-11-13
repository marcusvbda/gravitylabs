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
    public $formCreate = [
        'name' => '',
    ];
    public $formEdit = [
        'id' => '',
        'name' => '',
    ];

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
        return [
            "name" => $this->formCreate['name'],
        ];
    }

    public function onCreated($created): void
    {
        $this->formCreate["name"] = "";
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
            <x-input class="w-full" label="Name your $label" required model="formCreate.name" />
        BLADE;
    }

    public function makeEditForm($entity, $iconColor = 'var(--theme-color)', $append = ''): string
    {
        $this->formEdit['name'] = $entity->name;
        $id = $entity->id;
        $letter = strtoupper(substr($entity->name, 0, 1));

        return <<<BLADE
            <div class="w-full flex flex-col gap-4" style="--modal-item-default-color: $iconColor">
                <div class="flex items-start justify-between mb-8">
                    <div class="size-24 min-w-24 rounded-xl flex items-center justify-center text-white text-5xl font-bold"
                            style="background-color: var(--modal-item-default-color)">
                            $letter 
                    </div>
                    <a href="#" x-on:click="editModalVisible = false" class="group cursor-pointer">
                        <x-icons.close class="size-10 opacity-50 transition-all duration-300 group-hover:opacity-100" />
                    </a>
                </div>
                <x-inline-edit index="name" entityId="$id">
                    <x-slot name="source">
                        <h1 class="text-2xl text-left w-full font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                            $entity->name
                        </h1>
                    </x-slot>
                    <x-input class="w-full" required model="formEdit.name" />
                </x-inline-edit>
                $append
            </div>
        BLADE;
    }

    public function onSaveInline($index, $entityId): void
    {
        $entity = app()->make($this->model)->findOrFail($entityId);
        $entity->{$index} = $this->formEdit[$index];
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
        $this->formEdit['id'] = $id;
    }
}
