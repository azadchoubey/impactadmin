<?php

namespace App\Livewire;

use App\Models\Picklist;
use App\Models\Pubmaster;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\PubPageName;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CreatePublication extends Component
{
    use WithFileUploads;

    public $title;
    public $edition;
    public $issn;
    public $category;
    public $frequency;
    public $type;
    public $region;
    public $size;
    public $language;
    public $mu,$restrictedmu,$primary;
    public $pagenames;
    public $circulation;
    public $RatePC;
    public $RatePB;
    public $RateNC;
    public $RateNB;
    public $masthead;
    public $checkboxes =[];
    public $primaryDisabled = true; 
    protected $rules = [
        'title' => 'required',
        'edition'=>'required',
        'category'=>'required',
        'region'=>'required',
        'language'=>'required',
        'masthead' => 'image',
        'RatePC'=>'numeric',
        'RatePB'=>'numeric',
        'RateNC'=>'numeric',
        'RateNB'=>'numeric',
        'size'=>'numeric',
        'circulation'=>'numeric',
    ];
    protected $messages = [
        'title.required' => 'The Name cannot be empty.',
        'category.required' => 'The category cannot be empty.',
        'region.required' => 'The region cannot be empty.',
        'language.required' => 'The language cannot be empty.',
        'RatePC.numeric' => 'The Premium color field must be a number',
        'RatePB.numeric' => 'The Premium B&W field must be a number',
        'RateNC.numeric' => 'The Non Premium color field must be a number',
        'RateNB.numeric' => 'The Non Premium B&W field must be a number',

    ];
    public function togglePrimary()
    {
        $this->primaryDisabled = !$this->primaryDisabled;
    }
    public function render()
    {
        $data = Picklist::whereIn('Type',['Region','Language','Pub Category','Pubtype','city'])->get()->groupBy('Type');   
        $data['pubmaster'] = Pubmaster::where('deleted',0)->orderBy('Title')->get(); 
        return view('livewire.create-publication',compact('data'));
    }
    public function addCheckbox()
    {
        if (!empty($this->pagenames)) {
            $this->checkboxes[] = ['Name' => $this->pagenames, 'IsPre' => 1];
            $this->pagenames = ''; 
        }
    }
    public function submitForm(){
        $this->validate();
       try{
        DB::beginTransaction();
        $pubid = Pubmaster::insertGetId([
            'PrimaryPubID' => $this->primaryDisabled?$this->primary:0,
            'Title' => $this->title,
            'Place' => 0,
            'Category' => $this->category,
            'Type' => $this->type,
            'Region' => $this->region,
            'Language' => $this->language,
            // 'restrictedmu' => $this->restrictedmu,
            // 'mu' => $this->mu,
            'MastHead' => $this->masthead->store('images/publications/masthead'),
            'Circulation' => $this->circulation,
            'Issn_Num' => $this->issn,
            // 'frequency' => $this->frequency,
            'Size' => $this->size,
            'WebSite'=>'',
            'RatePC' => $this->RatePC,
            'RateNC' => $this->RateNC,
            'RatePB' => $this->RatePB,
            'RateNB' => $this->RateNB,
            'CreateDateTime'=>now(),
            'EditDateTime'=>now()
        ]);
        foreach($this->checkboxes as $pagename){
            if($pagename["IsPre"] == true || $pagename["IsPre"] == false){
                $pagename["IsPre"] = $pagename["IsPre"] == true?"1":"0";
            }       
            PubPageName::updateOrCreate([
                "PubId"=>$pubid,
                "Name"=>$pagename["Name"]
    
            ],$pagename);
           
        }
        Log::info('created new publication name: {name} and Pubid: {pubid} by user: {user} ',['name'=>$this->title,'user'=>auth()->user()->UserID,'pubid'=>$pubid]);
        session()->flash('success', 'Record Added successfully!');
        return redirect()->to('/publications');
       }catch(Exception $e){
        Log::error('Error while creating publication: {error}', ['error' => $e->getMessage()]);
        session()->flash('error', 'An error occurred while adding the record.');

       }

    }


    public function removeCheckbox($index)
    {
        unset($this->checkboxes[$index]);
        $this->checkboxes = array_values($this->checkboxes); // Re-index the array
    }
}
