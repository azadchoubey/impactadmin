<?php

namespace App\Livewire;

use App\Models\Picklist;
use App\Models\Pubmaster;
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
        'pagename'=>'required',
        

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
        Pubmaster::create([
            'PubId' => $this->pubid,
            'PrimaryPubID' => $this->primary,
            'Title' => $this->title,
            'address1' => $this->address1,
            'place' => $this->edition,
            'address2' => $this->address2,
            'Category' => $this->category,
            'address3' => $this->address3,
            'Type' => $this->type,
            'CityID' => $this->city,
            'Region' => $this->region,
            'stateID' => $this->state,
            'Language' => $this->language,
            'countryID' => $this->country,
            // 'pagenames' => $this->pagenames,
            'IsDomestic' => $this->domestic??0,
            // 'international' => $this->international,
            'phone' => $this->phone,
            // 'restrictedmu' => $this->restrictedmu,
            // 'mu' => $this->mu,
            'MastHead' => $this->masthead,
            'Circulation' => $this->circulation,
            'Issn_Num' => $this->issn,
            // 'frequency' => $this->frequency,
            'WebSite' => $this->website,
            'Size' => $this->size,
            'RatePC' => $this->RatePC,
            'RateNC' => $this->RateNC,
            'RatePB' => $this->RatePB,
            'RateNB' => $this->RateNB,
        ]);
        session()->flash('success', 'Record Added successfully!');
        return redirect()->to('/publications');
    }
}
