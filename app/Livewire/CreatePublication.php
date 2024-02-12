<?php

namespace App\Livewire;

use App\Models\Picklist;
use Livewire\Component;

class CreatePublication extends Component
{
    public $pubid;
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
    public $domestic;
    public $international;
    public $pagenames;
    public $circulation = '';
    public $RatePC;
    public $RatePB;
    public $RateNC;
    public $RateNB;
    public $masthead;
    public $checkboxes =[];
    public function render()
    {
        $data = Picklist::whereIn('Type',['City','Region','Language','Country','State','Pub Category','Pubtype'])->get()->groupBy('Type');
        //dd($data );
        return view('livewire.create-publication',compact('data'));
    }
    public function addCheckbox()
    {
        if (!empty($this->pagenames)) {
            $this->checkboxes[] = $this->pagenames;
            $this->pagenames = ''; 
        }
    }
}
