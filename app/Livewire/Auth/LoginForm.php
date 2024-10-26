<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Validator;
use Livewire\Component;

class LoginForm extends Component
{
    public $email = '';
    public $password = '';

    public function submit()
    {
        $validator = Validator::make([
            'email' => $this->email,
            'password' => $this->password,
        ], [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->dispatch('onNewMessage', [
                'type' => 'error',
                'text' => '<ul><li>' . implode('</li><li>', $validator->errors()->all()) . '</li></ul>'
            ]);
        }
        // sleep(10);
        // $this->redirect("https://www.google.com");
        return $this->dispatch('onNewMessage', [
            'type' => 'success',
            'text' => 'Login successfully'
        ]);
    }

    public function render()
    {
        return view('livewire.auth.login-form');
    }
}
