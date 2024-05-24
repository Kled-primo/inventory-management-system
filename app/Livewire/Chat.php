<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Chat extends Component
{
    public function mount()
    {
        //Check user role
        $loggedInUser = User::findOrFail(Auth::user()->id);

        $loggedInUser->hasRole(['Super Admin','employee']);

        if ($loggedInUser) {

        }

    }
    public function render()
    {
        return view('livewire.chat');
    }
}
