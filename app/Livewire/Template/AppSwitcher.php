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
        $found = $selected ? MyApp::findOrFail($selected) : null;
        if (!$found) {
            $first = MyApp::orderBy("name", 'asc')->first();
            if (!$first) return;
            $this->selectApp($first->id);
            $found = $first;
        }
        $this->selectedApp = $found;
    }

    public function makeQuery(): mixed
    {
        return MyApp::where("id", "!=", $this->user->settings->selected_app)->orderBy("name", 'asc');
    }

    #[On('selectApp')]
    public function selectApp($id, $loadList = false): void
    {
        $settings = $this->user->settings;
        $settings->selected_app = $id;
        $this->user->settings = $settings;
        $this->user->save();
        $this->selectedApp = MyApp::findOrFail($id);
        if ($loadList) $this->loadList();
        $this->js("Livewire.navigate(window.location.href);");
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
