<?php

namespace App\Livewire\Template;

use Livewire\Component;
use Auth;
use Illuminate\Contracts\View\View;

class ThemeSwitcher extends Component
{
    public $theme;
    public function mount(): void
    {
        $this->theme = Auth::user()->settings?->theme ?? config('app.default_theme');
    }

    public function toggleTheme(): void
    {
        $this->theme = $this->theme == 'light' ? 'dark' : 'light';
        $user = Auth::user();
        $settings = $user->settings;
        $settings->theme = $this->theme;
        $user->settings = $settings;
        $user->save();
        $this->dispatch('theme-changed', $this->theme);
    }

    public function render(): mixed
    {
        return view('livewire.template.theme-switcher');
    }
}
