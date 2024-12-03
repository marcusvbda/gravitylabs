<?php

namespace App\Livewire\Application;

use App\Livewire\Crud;
use App\Models\Page;
use Livewire\Attributes\Title;

#[Title('Pages')]
class Pages extends Crud
{
    public $icon = 'icons.apps';
    public $label = "Page";
    public $plural = "Pages";
    public $title = "Pages";
    public $createBtnText = 'Create a page';
    public $formCreateBtnText = 'Get started';
    public $model = Page::class;
    public $formCreate = [
        "name" => "",
    ];
    public $sidebar = [
        'Quick links' => [
            'Applications' => 'app.applications.index',
            'Pages' => 'app.pages.index',
        ],
    ];
}
