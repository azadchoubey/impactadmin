<?php

namespace App\Livewire;

use App\Models\MediaUniverseMaster;
use App\Models\Picklist;
use App\Models\Pubbase;
use App\Models\PublicationLog;
use App\Models\Pubmaster;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\PubPageName;
use App\Models\RemoteMediaMaster;
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
        'type'=>'required',
        'category'=>'required',
        'region'=>'required',
        'language'=>'required',
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
        $data = Picklist::whereIn('Type',['Region','Language','Pub Category','Pubtype','city','periodicity'])->get()->groupBy('Type');   
        $data['pubmaster'] = Pubmaster::where('deleted',0)->orderBy('Title')->get(); 
        return view('livewire.create-publication',compact('data'));
    }
    public function addCheckbox()
    {
        if (!empty($this->pagenames)) {
            $this->checkboxes[] = ['Name' => $this->pagenames, 'IsPre' => 0];
            $this->pagenames = ''; 
        }
    }
    public function submitForm(){
      
        $this->validate();
       try{
        $pub = Pubmaster::where(['Title'=> $this->title,'place'=> $this->edition])->where('deleted', '!=', 1)->first();
       
        if($pub){
            $this->dispatch('alert', 'Publication already exists.');
            return;
        }

        $baseid = Pubbase::where('name',$this->title)->first();
        if($baseid){
            $baseid = $baseid->baseid;

        }else{
            $baseid = Pubbase::insertGetId([
                'name' =>  $this->title,
                'webid'=>0
            ]);
        }
        DB::beginTransaction();
        $pubid = Pubmaster::insertGetId([
            'PrimaryPubID' => $this->primary?$this->primary:0,
            'Title' => $this->title,
            'Place' => $this->edition,
            'Category' => $this->category,
            'Type' => $this->type,
            'Region' => $this->region,
            'Language' => $this->language,
            'baseid'=>$baseid,
            'IsMain' => $this->mu?1:0,
            'MastHead' => '',
            'Circulation' => $this->circulation,
            'Issn_Num' => $this->issn,
            'Periodicity' => $this->frequency,
            'Size' => $this->size,
            'WebSite'=>'',
            'RatePC' => $this->RatePC,
            'RateNC' => $this->RateNC,
            'RatePB' => $this->RatePB,
            'RateNB' => $this->RateNB,
            'CreateDateTime'=>now(),
            'EditDateTime'=>now()
        ]);
       
        if ($this->masthead) {
            $mastheadPath = $this->masthead->storeAs('images/publications/masthead', $pubid . '.' . $this->masthead->getClientOriginalExtension());
            Pubmaster::where('PubId', $pubid)->update(['MastHead' => $mastheadPath]);
        }

        foreach($this->checkboxes as $pagename){
            if($pagename["IsPre"] == true || $pagename["IsPre"] == false){
                $pagename["IsPre"] = $pagename["IsPre"]?"1":"0";
            }       
            PubPageName::updateOrCreate([
                "PubId"=>$pubid,
                "Name"=>$pagename["Name"]
    
            ],$pagename);
           
        }
        MediaUniverseMaster::where('pubid',$pubid)->delete();
        RemoteMediaMaster::where('pubid',$pubid)->delete();
        if($this->mu){
            MediaUniverseMaster::insertFromQuery($pubid);
            RemoteMediaMaster::insertFromQuery($pubid);
           
        }
        DB::commit();
        Log::info('created new publication name: {name} and Pubid: {pubid} by user: {user} ',['name'=>$this->title,'user'=>auth()->user()->UserID,'pubid'=>$pubid]);
        session()->flash('success', 'Record Added successfully!');
        return redirect()->to('/publications');
       }catch(Exception $e){
        DB::rollBack();
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
