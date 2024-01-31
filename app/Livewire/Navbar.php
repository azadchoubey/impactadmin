<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Navbar extends Component
{
    public function render()
    {
        return view('livewire.navbar');
    }
    public function changepassword()
    {
        return redirect()->route('changepassword');
    }
    public function logout()
    {
        Auth::logout();
        if(!session()->get('remember')){
            session()->forget(['userid', 'pass']);
        }
       
        return redirect()->to('/');
    }
}
