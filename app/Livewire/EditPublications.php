<?php

namespace App\Livewire;

use App\Models\Picklist;
use App\Models\Pubmaster;
use App\Models\PubPageName;
use Livewire\Component;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class EditPublications extends Component
{

    public $pubid;
    public $title;
    public $edition;
    public $issn;
    public $category;
    public $frequency;
    public $type;
    public $region;
    public $size;
    public $language;
    public $pagenames = [], $checkboxes = [];
    public $circulation = '';
    public $page;
    public $RatePC;
    public $RatePB;
    public $RateNC;
    public $RateNB;
    public $id;
    public $masthead, $primary, $webuniverse, $restrictedmu, $mu, $primaryname;

    protected $rules = [
        'RatePC'=>'required|numeric',
        'RatePB'=>'required|numeric',
        'RateNC'=>'required|numeric',
        'RateNB'=>'required|numeric',
        'size'=>'required|numeric',
        'circulation'=>'required|numeric',
        'title' => 'required',
        'edition'=>'required',
        'category'=>'required',
        'region'=>'required',
        'language'=>'required'
,
    ];
    protected $messages = [
        'title.required' => 'The Name cannot be empty.',
        'edition.required' => 'The edition cannot be empty.',
        'category.required' => 'The category cannot be empty.',
        'region.required' => 'The region cannot be empty.',
        'language.required' => 'The language cannot be empty.',
        'RatePC.numeric' => 'The Premium color field must be a number',
        'RatePB.numeric' => 'The Premium B&W field must be a number',
        'RateNC.numeric' => 'The Non Premium color field must be a number',
        'RateNB.numeric' => 'The Non Premium B&W field must be a number',
        'RatePC.required' => 'The Premium color field cannot be empty',
        'RatePB.required' => 'The Premium B&W field cannot be empty',
        'RateNC.required' => 'The Non Premium color field cannot be empty',
        'RateNB.required' => 'The Non Premium B&W field cannot be empty',

    ];
    public function mount($id)
    {
        $this->id = base64_decode($id);
        $data = Pubmaster::with('Type', 'city', 'country', 'state', 'cat', 'lang', 'pub_pages', 'edition','frequency')->find($this->id);

        $this->title = $data->Title;
        $this->pubid = $data->PubId;
        $this->edition = $data->edition->ID;
        $this->language = $data->Lang->ID;
        $this->issn = $data->Issn_Num;
        $this->type = $data->type->ID;
        $this->category = $data->cat->ID;
        $this->frequency = $data->Periodicity;
        $this->region = $data->region->ID;
        $this->size = $data->Size;
        $this->pagenames = $data->pub_pages->toArray();
        $this->checkboxes = $data->pub_pages->pluck('IsPre', 'PageNameID')->toArray();
        $this->circulation = $data->Circulation;
        $this->RateNB = $data->RateNB;
        $this->RatePC = $data->RatePC;
        $this->RateNC = $data->RateNC;
        $this->RatePB = $data->RatePB;
        $this->masthead = $data->MastHead;
        $this->primary = $data->PrimaryPubID;
        $this->primaryname = $this->primary == 0 ? false:true;
       
    }
    public function render()
    {


            $picklist = Picklist::whereIn('Type', [ 'City', 'Region', 'Language', 'Pub Category', 'Pubtype','Periodicity'])->get()->groupBy('Type');
            $data['pubmaster'] = Pubmaster::where('deleted',0)->get(); 
     
        return view('livewire.edit-publications', compact('picklist','data'));
    }
    public function togglePrimary()
    {
        $this->primaryname = !$this->primaryname;
    }
    public function submitForm()
    {
        $this->validate();
        $pubmaster = Pubmaster::findOrFail($this->pubid);
        try{
        DB::beginTransaction();
        $pubmaster->update([
            'PubId' => $this->pubid,
            'PrimaryPubID' => $this->primary,
            'Title' => $this->title,
            'place' => $this->edition,
            'Category' => $this->category,
            'Type' => $this->type,
            'Region' => $this->region,
            'Language' => $this->language,
            'IsDomestic' => $this->domestic??0,
            // 'restrictedmu' => $this->restrictedmu,
            // 'mu' => $this->mu,
            'MastHead' => $this->masthead,
            'Circulation' => $this->circulation,
            'Issn_Num' => $this->issn,
            // 'frequency' => $this->frequency,
            'Size' => $this->size,
            'RatePC' => $this->RatePC,
            'RateNC' => $this->RateNC,
            'RatePB' => $this->RatePB,
            'RateNB' => $this->RateNB,
        ]);
       
        foreach($this->pagenames as $pagename){
            if($pagename["IsPre"] == true || $pagename["IsPre"] == false){
                $pagename["IsPre"] = $pagename["IsPre"] == true?"1":"0";
            }     
          
            PubPageName::updateOrCreate([
                "PubId"=>$pagename['PubId'],
                "Name"=>$pagename["Name"]
    
            ],$pagename);
           
        }
    
        Log::info('Record updaterd publication name: {name} and Pubid: {pubid} by user: {user} ',['name'=>$this->title,'user'=>auth()->user()->UserID,'pubid'=>$this->pubid]);
        session()->flash('success', 'Your changes have been saved successfully!');
        return redirect()->to('/publications');
    }catch(Exception $e){
        Log::error('Error while creating publication: {error}', ['error' => $e->getMessage()]);
        session()->flash('error', 'An error occurred while adding the record.');

       }
    }public function addCheckbox()
    {
        if ($this->page) {
            $newPageName = PubPageName::create([
                'Name' => $this->page,
                'IsPre' => 0, 
            ]);
    
            $this->pagenames[] = [
                'PageNameID' => $newPageName->id, 
                'Name' => $this->page,
                'IsPre' => 0, 
            ];
                $this->page = '';
        }
    }
    

    public function removePage($index)
    {
        if (isset($this->pagenames[$index]['PageNameID'])) {
            PubPageName::find($this->pagenames[$index]['PageNameID'])->delete();
        }
    
        unset($this->pagenames[$index]);
    
        $this->pagenames = array_values($this->pagenames);
    }
    


}
