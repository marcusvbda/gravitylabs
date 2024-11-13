<?php

namespace App\Livewire\Application;

use App\Livewire\Crud;
use App\Models\MyApp;
use Livewire\Attributes\Title;

#[Title('My apps')]
class MyApps extends Crud
{
    public $icon = 'icons.apps';
    public $label = "App";
    public $plural = "Apps";
    public $title = "My apps";
    public $createBtnText = 'Create an app';
    public $model = MyApp::class;
    public $formCreate = [
        "name" => "",
        "primary_color" => "#2963e5"
    ];


    public function makeCreateForm(): string
    {
        $this->primary_color = config("app.default_theme_color");
        return parent::makeCreateForm() . <<<BLADE
            <x-input class="w-full" type="color" inputClass="h-10 py-1" label="Primary color" required
                    model="formCreate.primary_color" />
        BLADE;
    }

    public function createPayload(): array
    {
        return [
            "name" => $this->formCreate['name'],
            "primary_color" => $this->formCreate['primary_color'],
        ];
    }

    public function onCreated($created): void
    {
        $this->formCreate["name"] = "";
        $this->primary_color = config("app.default_theme_color");
        if (MyApp::count() === 1) {
            $this->dispatch("selectApp", $created->id, loadList: true);
        } else {
            $this->dispatch("loadAppsList", $created->id, loadList: true);
        }
    }

    public function makeEditForm($entity, $iconColor = '', $append = ''): string
    {
        $id = $entity->id;
        $this->formEdit["id"] = $id;
        $this->formEdit["name"] = $entity->name;
        $this->formEdit["primary_color"] = $entity->primary_color;

        return parent::makeEditForm($entity, $entity->primary_color, <<<BLADE
            <x-inline-edit index="primary_color" entityId="$id">
                <x-slot name="source">
                    <div class="h-10 w-full min-w-14 rounded-2xl flex items-center justify-center text-white text-2xl font-bold"
                        style="background-color:  $entity->primary_color"></div>
                </x-slot>
                <x-input class="w-full" type="color" inputClass="h-10 py-1" required model="formEdit.primary_color" />
            </x-inline-edit>
        BLADE);
    }
}
