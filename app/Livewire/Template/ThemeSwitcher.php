<?php

namespace App\Livewire\Template;

use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Auth;

class ThemeSwitcher extends Component
{
    public $theme;
    public function __construct()
    {
        $this->theme = Auth::user()->settings?->theme ?? config('app.default_theme');
    }

    public function toggleTheme()
    {
        $this->theme = $this->theme == 'light' ? 'dark' : 'light';
        $user = Auth::user();
        $settings = $user->settings;
        $settings->theme = $this->theme;
        $user->settings = $settings;
        $user->save();
        $this->js('window.location.reload()');
    }

    public function render()
    {
        return view('livewire.template.theme-switcher');
    }
}
