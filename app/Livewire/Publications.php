<?php

namespace App\Livewire;

use App\Models\Pubmaster;
use Livewire\Component;

class Publications extends Component
{
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
    public $domestic;
    public $international;
    public $primary;
    public $pagenames= [];
    public $circulation = '';
    public $isOpen = false;
    public $RatePC;
    public $RatePB;
    public $RateNC;
    public $RateNB;
    public $id;
    public $pubshow = false;
    public $masthead;
    public function render()
    {
   
        return view('livewire.publications');
    }
    public function updateTitle()
    {
        $this->pubshow = false;

        if(strlen($this->title) >= 2){ 
            $this->searchResults = Pubmaster::where('Title','LIKE','%'.$this->title.'%')->where('deleted',0)
            ->with('edition')
            ->get();
            $this->isOpen = True;
        } else {
            $this->searchResults = [];
        }
    }
    public function fetchAll($id,$title){

            $this->searchResults = [];
            $this->title = $title;
            $this->id = $id;
    
       
    }
    public function pubsubmit() {
        if($this->id){
        $this->pubshow = true;
        $data = Pubmaster::with('Type','city','country','state','cat','lang','pub_pages','edition')->find($this->id);
        //dd($data);
          $this->pubid = $data->PubId;
          $this->address1 = $data->address1;
          $this->address2 = $data->address2;
          $this->address3 = $data->address3;
          $this->city = $data->city?->Name;
          $this->state = $data->state->Name;
          $this->country = $data->country->Name;
          $this->edition = $data->edition->Name;
          $this->language = $data->Lang->Name;
          $this->issn = $data->Issn_Num;
          $this->type = $data->type->Name;
          $this->category = $data->cat->Name;
          $this->website = $data->WebSite;
          $this->region = $data->region->Name;
          $this->size = $data->Size;
          $this->phone = $data->phone;
          $this->domestic = $data->IsDomestic;
          $this->international = $data->IsDomestic?0:1;
          $this->primary = $data->PrimaryPubID;
          $this->pagenames = $data->pub_pages->toArray();
          $this->circulation = $data->Circulation;
          $this->RateNB = $data->RateNB;
          $this->RatePC = $data->RatePC;
          $this->RateNC = $data->RateNC;
          $this->RatePB = $data->RatePB;
          $this->masthead = $data->MastHead;
        }else{
            $this->skipRender();
        }
        
       
    }
}
