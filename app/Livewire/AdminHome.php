<?php

namespace App\Livewire;

use Livewire\Component;

class AdminHome extends Component
{
    protected $middleware = ['auth'];
    public function render()
    {
        return view('livewire.admin-home');
    }
}
