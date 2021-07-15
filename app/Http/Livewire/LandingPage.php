<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LandingPage extends Component
{
    public function render()
    {
        return view('livewire.landing-page');
    }

    public function login()
    {
        return redirect()->route('auth.login');
    }

    public function logout()
    {
        Auth::logout();
    }
}
