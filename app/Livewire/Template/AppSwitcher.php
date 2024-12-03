<?php

namespace App\Livewire\Template;

use App\Livewire\PaginatedList;
use App\Models\MyApp;
use Auth;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;


class AppSwitcher extends PaginatedList
{
    public $limit = 5;
    public $selectedApp = null;
    public $user = null;

    public function mount(): void
    {
        $this->user = Auth::user();
        $selected = @$this->user->settings->selected_app;
        $found = $selected ? MyApp::find($selected) : null;
        $this->selectedApp = $found;
    }

    public function getModel(): mixed
    {
        return  MyApp::query();
    }

    public function makeQuery(): mixed
    {
        return $this->getModel()->where("id", "!=", $this->user->settings->selected_app)->orderBy("name", 'asc');
    }

    #[On('selectApp')]
    public function selectApp($id, $loadList = false): void
    {
        $settings = $this->user->settings;
        $settings->selected_app = $id;
        $this->user->settings = $settings;
        $this->user->save();
        $this->selectedApp = $id ? MyApp::findOrFail($id) : null;
        if ($loadList) $this->loadList();
    }

    #[On('loadAppsList')]
    public function loadAppsList($id = null): void
    {
        $this->loadList();
    }

    public function render(): View
    {
        return view('livewire.template.app-switcher');
    }
}
