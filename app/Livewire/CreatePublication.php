<?php

namespace App\Livewire;

use App\Models\Picklist;
use Livewire\Component;

class CreatePublication extends Component
{
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
    public $domestic,$mu,$restrictedmu,$primary;
    public $international;
    public $pagenames;
    public $circulation = '';
    public $RatePC;
    public $RatePB;
    public $RateNC;
    public $RateNB;
    public $masthead;
    public $checkboxes =[];
    protected $rules = [
        'title' => 'required',
        'address1'=>'required',
        'city'=>'required',
        'state'=>'required',
        'country'=>'required',
        'phone'=>'required',
        'edition'=>'required',
        'category'=>'required',
        'mu'=>'required',
        'restrictedmu'=>'required',

    ];
    protected $messages = [
        'title.required' => 'The Name cannot be empty.',
        'address1.required' => 'The Address 1 cannot be empty.',
    ];
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
    public function submitForm(){
        $validatedData = $this->validate();
        dd($validatedData);
    }
}
