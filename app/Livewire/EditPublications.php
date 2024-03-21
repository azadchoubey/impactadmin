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

    protected $rules = [
        'title' => 'required',
        'address1'=>'required',
        'city'=>'required',
        'state'=>'required',
        'country'=>'required',
        'phone'=>'required',
        'edition'=>'required',
        'category'=>'required',
        'region'=>'required',
        'language'=>'required',
    ];
    protected $messages = [
        'title.required' => 'The Name cannot be empty.',
        'address1.required' => 'The Address 1 cannot be empty.',
        'city.required' => 'The city cannot be empty.',
        'state.required' => 'The state cannot be empty.',
        'country.required' => 'The country cannot be empty.',
        'phone.required' => 'Phone number cannot be empty.',
        'edition.required' => 'The edition cannot be empty.',
        'category.required' => 'The category cannot be empty.',
        'region.required' => 'The region cannot be empty.',
        'language.required' => 'The language cannot be empty.',

    ];
    public function mount($id)
    {
        $this->id = base64_decode($id);

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
    }
    public function render()
    {
        if ($this->id) {

            $picklist = Picklist::whereIn('Type', ['City', 'Region', 'Language', 'Country', 'State', 'Pub Category', 'Pubtype'])->get()->groupBy('Type');
          
        } 
        return view('livewire.edit-publications', compact('picklist'));
    }

    public function submitForm()
    {
        $validatedData = $this->validate();
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
        foreach($this->pagenames as $pagename){
            PubPageName::updateOrCreate([
                "PubId"=>$pagename['PubId'],
                "Name"=>$pagename["Name"]
    
            ],$this->pagenames);
        }
        

        session()->flash('success', 'Your changes have been saved successfully!');
        return redirect()->to('/publications');
        // $PubPageName = PubPageName::where('PubId', $this->pubid)->update();
    }
    public function addCheckbox()
    {
        $this->pagenames[]=['Name' =>  $this->page,'IsPre'=>1 ,'PubId'=>$this->pubid,'CreateDateTime'=>"0000-00-00 00:00:00",'EditDateTime'=>"0000-00-00 00:00:00"];
        $this->page = '';
    }

}
