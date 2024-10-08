<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Clinetprofile;
use Livewire\WithPagination; 

class ShowClientProfile extends Component
{
    use WithPagination;
    public $name,$pages;
    public function render()
    {
        return view('livewire.show-client-profile',[
            'Results' => Clinetprofile::orWhere('Name','LIKE','%'.$this->name.'%')->
            where('deleted','!=',1)->paginate($this->pages)
        ]);
    }
}
