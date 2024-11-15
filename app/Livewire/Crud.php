<?php

namespace App\Livewire;

use App\Livewire\PaginatedList;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Blade;
use Livewire\Attributes\Layout;

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
    public $editingId = '';
    public $formCreate = [
        'name' => '',
    ];
    public $formEdit = [
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
        // 
    }

    public function create($refreshPage = false): void
    {
        $created = app()->make($this->model)->create($this->createPayload());
        $this->onCreated($created);
        if ($refreshPage) {
            session()->flash('messages', [[
                'type' => 'success',
                'text' => $this->label . ' successfully created !'
            ]]);
            $this->redirect(url()->previous());
        } else {
            $this->sortBy = "created_at";
            $this->search = "";
            $this->formCreate["name"] = "";
            $this->dispatch('sendMessage', [
                'type' => 'success',
                'text' => $this->label . ' successfully created !'
            ]);
            $this->dispatch("closeCreateModal");
            $this->loadList();
        }
    }

    public function makeCreateForm(): string
    {
        $label = strtolower($this->label);
        return <<<BLADE
            <x-input class="w-full" label="Name your $label" required model="formCreate.name" />
        BLADE;
    }

    public function makeHeaderActionsEditForm($entity): string
    {
        $label = strtolower($this->label);

        return <<<BLADE
                <div class="flex flex-col gap-2 items-start my-8 w-full">
                    <a href="#" wire:click.prevent="deleteEntity($entity->id)" wire:confirm.prompt='Are you sure?\n\nType DELETE to confirm|DELETE' class="flex items-center gap-2 font-medium text-red-600 hover:underline ml-auto">
                        <x-icons.trash class="size-6"></x-icons.trash>
                        Delete $label
                    </a>
                </div>
        BLADE;
    }

    public function deleteEntity($id, $refreshPage = false): void
    {
        app()->make($this->model)->findOrFail($id)->delete();
        if ($refreshPage) {
            session()->flash('messages', [[
                'type' => 'success',
                'text' => $this->label . ' successfully deleted !'
            ]]);
            $this->redirect(url()->previous());
        } else {
            $this->loadList();
            $this->dispatch('sendMessage', [
                'type' => 'success',
                'text' => $this->label . ' successfully deleted !'
            ]);
            $this->dispatch("close-edit-modal");
            $this->editForm = '';
            $this->editingId = null;
        }
    }

    public function makeHeaderEditForm($entity): string
    {
        $letter = strtoupper(substr($entity->name, 0, 1));
        $actions = $this->makeHeaderActionsEditForm($entity);
        return <<<BLADE
                <div class="flex items-start justify-between">
                    <div class="size-24 min-w-24 rounded-xl flex items-center justify-center text-white text-5xl font-bold"
                            style="background-color: var(--modal-item-default-color)">
                            $letter 
                    </div>
                    <a href="#" x-on:click="editModalVisible = false" class="group cursor-pointer">
                        <x-icons.close class="size-10 opacity-50 transition-all duration-300 group-hover:opacity-100" />
                    </a>
                </div>
               $actions
        BLADE;
    }

    public function makeEditForm($entity, $append = ''): string
    {
        $this->formEdit["name"] = $entity->name;
        $inputName = $this->makeEditInput($entity, 'text', 'name');
        $header = $this->makeHeaderEditForm($entity);
        return $this->editViewContainer($entity, <<<BLADE
                $header
                $inputName
                $append
        BLADE);
    }

    public function makeEditInput($entity, $type, $index): string
    {
        $value = $entity->{$index};
        $formIndex = "formEdit.$index";
        if (in_array($type, ['text', 'number', 'password', 'email'])) {
            return <<<BLADE
                <x-inline-edit index="$index" >
                    <x-slot name="source">
                        <h1 class="text-2xl text-left w-full font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                           $value
                        </h1>
                    </x-slot>
                    <x-input class="w-full" type="$type" required model="$formIndex" />
                </x-inline-edit>
            BLADE;
        }


        if (in_array($type, ['color'])) {
            return <<<BLADE
                <x-inline-edit index="$index" >
                    <x-slot name="source">
                        <div class="h-10 w-full min-w-14 rounded-2xl flex items-center justify-center text-white text-2xl font-bold"
                            style="background-color:  $value"></div>
                    </x-slot>
                    <x-input class="w-full" type="color" inputClass="h-10 py-1" required model="$formIndex" />
                </x-inline-edit>
            BLADE;
        }


        return "type not supported";
    }

    public function editViewContainer($entity, $slot): string
    {
        $defaultColor = config("app.default_theme_color");
        return <<<BLADE
            <div class="w-full flex flex-col gap-4" style="--modal-item-default-color: $defaultColor">
                $slot
            </div>
        BLADE;
    }

    public function onSaveInline($index): void
    {
        $entity = app()->make($this->model)->findOrFail($this->editingId);
        $entity->{$index} = $this->formEdit[$index];
        $entity->save();
        $this->editForm = $this->makeEditForm($entity);
        $this->dispatch('refreshCrudItem', $this->model, $this->editingId);
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
