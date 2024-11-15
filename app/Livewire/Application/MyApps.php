<?php

namespace App\Livewire\Application;

use App\Livewire\Crud;
use App\Models\MyApp;
use Livewire\Attributes\Title;
use Auth;

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

    public function onCreated($created, $refreshPage = false): void
    {
        $user = Auth::user();
        $seletectedApp = $user->settings->selected_app;
        $found = $seletectedApp ? MyApp::find($seletectedApp) : null;

        if (!$found) {
            $settings = $user->settings;
            $settings->selected_app = $created->id;
            $user->settings = $settings;
            $user->save();
        }
    }

    public function create($refreshPage = false): void
    {
        $isFirst = MyApp::count() <= 0;
        parent::create($isFirst);
        if (!$isFirst) {
            $this->dispatch('loadAppsList');
        }
    }

    public function makeEditForm($entity, $iconColor = '', $append = ''): string
    {
        $this->formEdit["primary_color"] = $entity->primary_color;
        $colorInput = $this->makeEditInput($entity, 'color', 'primary_color');

        return parent::makeEditForm($entity, <<<BLADE
           $colorInput
        BLADE);
    }

    public function editViewContainer($entity, $slot): string
    {
        $iconColor = $this->formEdit["primary_color"] = $entity->primary_color;

        return <<<BLADE
            <div class="w-full flex flex-col gap-4" style="--modal-item-default-color: $iconColor">
                $slot
            </div>
        BLADE;
    }

    public function onSaveInline($index): void
    {
        parent::onSaveInline($index);
        $this->dispatch('loadAppsList');
    }

    public function deleteEntity($id, $refreshPage = false): void
    {
        $user = Auth::user();
        $seletectedApp = $user->settings->selected_app;
        if ($seletectedApp == $id) {
            $settings = $user->settings;
            $settings->selected_app = MyApp::where("id", "!=", $id)->first()?->id;
            $user->settings = $settings;
            $user->save();
        } else {
            $this->dispatch('loadAppsList');
        }
        parent::deleteEntity($id, $seletectedApp == $id);
    }
}
