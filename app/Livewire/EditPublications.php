<?php

namespace App\Livewire;

use App\Models\Picklist;
use App\Models\Pubmaster;
use App\Models\PubPageName;
use Livewire\Component;

class EditPublications extends Component
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
    public $pagenames = [], $checkboxes = [];
    public $circulation = '';
    public $isOpen = false;
    public $RatePC;
    public $page;
    public $RatePB;
    public $RateNC;
    public $RateNB;
    public $id;
    public $masthead, $primary, $webuniverse, $restrictedmu, $mu;
    public function mount($id)
    {
        $this->id = $id;
    }
    public function render()
    {
        if ($this->id) {
            $data = Pubmaster::with('Type', 'city', 'country', 'state', 'cat', 'lang', 'pub_pages', 'edition')->find($this->id);

            $this->title = $data->Title;
            $this->pubid = $data->PubId;
            $this->address1 = $data->address1;
            $this->address2 = $data->address2;
            $this->address3 = $data->address3;
            $this->city = $data->city?->ID;
            $this->state = $data->state->ID;
            $this->country = $data->country->ID;
            $this->edition = $data->edition->ID;
            $this->language = $data->Lang->ID;
            $this->issn = $data->Issn_Num;
            $this->type = $data->type->ID;
            $this->category = $data->cat->ID;
            $this->website = $data->WebSite;
            $this->region = $data->region->ID;
            $this->size = $data->Size;
            $this->phone = $data->phone;
            $this->domestic = $data->IsDomestic;
            $this->international = $data->IsDomestic ? 0 : 1;
            $this->pagenames = $data->pub_pages->toArray();
            $this->checkboxes = $data->pub_pages->pluck('IsPre', 'PageNameID')->toArray();
            $this->circulation = $data->Circulation;
            $this->RateNB = $data->RateNB;
            $this->RatePC = $data->RatePC;
            $this->RateNC = $data->RateNC;
            $this->RatePB = $data->RatePB;
            $this->masthead = $data->MastHead;
            $this->primary = $data->PrimaryPubID;
            $picklist = Picklist::whereIn('Type', ['City', 'Region', 'Language', 'Country', 'State', 'Pub Category', 'Pubtype'])->get()->groupBy('Type');
           // dd($this->checkboxes);
        } 
        return view('livewire.edit-publications', compact('picklist'));
    }

    public function submitForm()
    {
        //dd($this->pagenames);
        $pubmaster = Pubmaster::findOrFail($this->pubid);
        $pubmaster->update([
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
        session()->flash('success', 'Your changes have been saved successfully!');

        // $PubPageName = PubPageName::where('PubId', $this->pubid)->update();
    }
    public function addCheckbox()
    {
      
            $rand = rand(00000,9999);
            $this->checkboxes [ $rand]= true;
            $this->pagenames[]=[ 'PageNameID' =>  $rand,'Name' =>  $this->page];
            $this->page = '';
           //dd($this->pagenames);
        
    }

}
