<?php

namespace App\Livewire\Template;

use App\Models\Application;
use Livewire\Component;
use Illuminate\Support\Collection;
use Auth;
use Illuminate\Contracts\View\View;

class AppSwitcher extends Component
{
    public Collection $items;
    public $limit = 5;
    public $total = null;
    public $hasMorePages = false;
    public $selectedApp = null;
    public $user = null;

    public function __construct()
    {
        $this->user = Auth::user();
        $selected = @$this->user->settings->selected_app;
        $found = $selected ? Application::findOrFail($selected) : null;
        if (!$found) {
            $first = Application::orderBy("name", 'asc')->first();
            $this->selectApp($first->id, false);
            $found = $first;
        }
        $this->selectedApp = $found;
    }

    public function loadList($skip = 0): void
    {
        $query = Application::where("id", "!=", $this->user->settings->selected_app)->orderBy("name", 'asc');
        $this->total = $query->count();
        $query = $query->take($this->limit)->skip($skip);
        $this->items = !$skip ?  $query->get() : $this->items->toBase()->merge($query->get());
        $this->hasMorePages = $this->items->count() < $this->total;
    }

    public function loadMore(): void
    {
        $this->loadList($this->items->count());
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
