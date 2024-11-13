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
    public $primaryColor = "#2963e5";


    public function makeCreateForm(): string
    {
        $this->primaryColor = config("app.default_theme_color");
        return parent::makeCreateForm() . <<<BLADE
            <x-input class="w-full" type="color" inputClass="h-10 py-1" label="Primary color" required
                    model="primaryColor" />
        BLADE;
    }

    public function createPayload(): array
    {
        return [
            "name" => $this->name,
            "primary_color" => $this->primaryColor
        ];
    }

    public function onCreated($created): void
    {
        $this->name = "";
        $this->primaryColor = config("app.default_theme_color");
        if (MyApp::count() === 1) {
            $this->dispatch("selectApp", $created->id, loadList: true);
        } else {
            $this->dispatch("loadList");
        }
    }

    public function makeEditForm($entity): string
    {
        $this->name = $entity->name;
        $this->primaryColor = $entity->primaryColor;
        $id = $entity->id;
        return <<<BLADE
            <x-inline-edit index="name" entityId="$id">
                <x-slot name="source">
                    <h1 class="text-2xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        $this->name
                    </h1>
                </x-slot>
                <x-input class="w-full" required model="name" />
            </x-inline-edit>
            <x-inline-edit index="primaryColor" entityId="$id">
                <x-slot name="source">
                    $this->primaryColor
                </x-slot>
                <x-input class="w-full" type="color" required model="primaryColor" />
            </x-inline-edit>
        BLADE;
    }
}
