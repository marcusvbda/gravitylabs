<?php

namespace App\Livewire;

use App\Livewire\PaginatedList;
use App\Models\MyApp;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;

class CrudItem extends PaginatedList
{
    public $item;

    #[On('refreshCrudItem')]
    public function refresh($model, $id): void
    {
        if ($id === $this->item->id) {
            $this->item = app()->make($model)->findOrFail($id);
        }
    }

    public function makeQuery(): mixed
    {
        return MyApp::query();
    }

    public function render(): View
    {
        return view('livewire.crud.crudItem');
    }
}
