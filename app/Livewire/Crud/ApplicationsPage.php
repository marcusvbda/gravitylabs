<?php

namespace App\Livewire\Crud;

use App\Models\Application;
use Livewire\Attributes\Title;

#[Title('My apps')]
class ApplicationsPage extends CrudPage
{
    public $icon = 'icons.apps';
    public $label = "App";
    public $plural = "Apps";
    public $title = "My apps";
    public $createBtnText = 'Create an app';
    public $model = Application::class;
    public $newAppPrimaryColor = "#01309B";
    public $newAppName = "";

    public function createPayload(): array
    {
        return [
            "name" => $this->newAppName,
            "primary_color" => $this->newAppPrimaryColor
        ];
    }

    public function onCreated(): void
    {
        $this->newAppName = "";
        $this->newAppPrimaryColor = "#235edf";
    }
}
