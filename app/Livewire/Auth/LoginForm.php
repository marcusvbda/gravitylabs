<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Auth;

class LoginForm extends Component
{
    public $email = 'root@root.com';
    public $password = 'roottoor';
    public $remember = true;
    public $redirectTo;

    public function mount()
    {
        $this->redirectTo = request()?->redirectTo ?? route('app.applications.index');
    }

    public function submit()
    {
        $validator = Validator::make([
            'email' => $this->email,
            'password' => $this->password,
            'redirectTo' => $this->redirectTo
        ], [
            'email' => 'required|email',
            'password' => 'required',
            'redirectTo' => 'required|url'
        ]);

        if ($validator->fails()) {
            return $this->dispatch('onNewMessage', [
                'type' => 'error',
                'text' => '<ul><li>' . implode('</li><li>', $validator->errors()->all()) . '</li></ul>'
            ]);
        }

        $logged = Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember);
        if (!$logged) {
            return $this->dispatch('onNewMessage', [
                'type' => 'error',
                'text' => 'Invalid credentials'
            ]);
        }

        return redirect($this->redirectTo);
    }

    public function render()
    {
        return view('livewire.auth.login-form');
    }
}
