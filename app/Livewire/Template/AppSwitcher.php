<?php

namespace App\Livewire\Template;

use App\Livewire\PaginatedList;
use App\Models\Application;
use Auth;
use Illuminate\Contracts\View\View;

class AppSwitcher extends PaginatedList
{
    public $limit = 5;
    public $selectedApp = null;
    public $user = null;

    public function __construct()
    {
        $this->user = Auth::user();
        $selected = @$this->user->settings->selected_app;
        $found = $selected ? Application::findOrFail($selected) : null;
        if (!$found) {
            $first = Application::orderBy("name", 'asc')->first();
            if (!$first) return;
            $this->selectApp($first->id);
            $found = $first;
        }
        $this->selectedApp = $found;
    }

    public function makeQuery(): mixed
    {
        return Application::where("id", "!=", $this->user->settings->selected_app)->orderBy("name", 'asc');
    }

    public function selectApp($id): void
    {
        $settings = $this->user->settings;
        $settings->selected_app = $id;
        $this->user->settings = $settings;
        $this->user->save();
        $this->selectedApp = $this->items->find($id);
        $this->js("Livewire.navigate(window.location.href);");
    }

    public function render(): View
    {
        return view('livewire.template.app-switcher');
    }
}
