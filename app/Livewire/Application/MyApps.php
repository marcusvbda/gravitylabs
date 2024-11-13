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
    public $newAppPrimaryColor = "#01309B";
    public $newAppName = "";

    public function createPayload(): array
    {
        return [
            "name" => $this->newAppName,
            "primary_color" => $this->newAppPrimaryColor
        ];
    }

    public function onCreated($created): void
    {
        $this->newAppName = "";
        $this->newAppPrimaryColor = "#235edf";
        if (MyApp::count() === 1) {
            $this->dispatch("selectApp", $created->id, loadList: true);
        } else {
            $this->dispatch("loadList");
        }
    }
}
