<?php

namespace App\Http\Livewire;

use Livewire\Component;

class LoginWithDiscord extends Component
{
    public function render()
    {
        return view('livewire.login-with-discord');
    }

    public function loginWithDiscord()
    {
        return redirect()->route('discord.login');
    }
}
