<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Clinetprofile;

class ShowClientProfile extends Component
{
    public $name,$page;
    public function render()
    {
        return view('livewire.show-client-profile',[
            'Results' => Clinetprofile::orWhere('Name','LIKE','%'.$this->name.'%')
            ->paginate($this->page)
        ]);
    }
}
