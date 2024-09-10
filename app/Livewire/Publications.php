<?php

namespace App\Livewire;

use App\Models\Pubmaster;
use Livewire\Component;
use Livewire\WithPagination;

class Publications extends Component
{
    use WithPagination;
    public $pubid;
    public $searchResults = [];
    public $title;
    public $address1;
    public $address2;
    public $address3;
    public $city;
    public $state;
    public $country;
    public $phone;
    public $edition;
    public $issn;
    public $category;
    public $frequency;
    public $type;
    public $website;
    public $region;
    public $size;
    public $language;
    public $domestic,$restrictedmu,$mu;
    public $international;
    public $primary;
    public $pagenames= [];
    public $circulation = '';
    public $isOpen = false;
    public $RatePC;
    public $RatePB;
    public $RateNC;
    public $RateNB;
    public $_id;
    public $pubshow = false;
    public $masthead;
    public $pages = 10;
    public function render()
    {
        
       // $this->pubshow = false;
        return view('livewire.publications',[
            'Results' => Pubmaster::where('Title','LIKE','%'.$this->title.'%')->where('deleted',0)
            ->with('edition')->orderBy('Title')
            ->paginate($this->pages )
        ]);
    }

    
}