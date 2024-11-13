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
            $this->selectApp($first->id, false);
            $found = $first;
        }
        $this->selectedApp = $found;
    }

    public function makeQuery(): mixed
    {
        return Application::where("id", "!=", $this->user->settings->selected_app)->orderBy("name", 'asc');
    }

    public function selectApp($id, $reload = true): void
    {
        $settings = $this->user->settings;
        $settings->selected_app = $id;
        $this->user->settings = $settings;
        $this->user->save();
        if ($reload) {
            $this->js("window.location.reload();");
        }
    }

    public function render(): View
    {
        return view('livewire.template.app-switcher');
    }
}
