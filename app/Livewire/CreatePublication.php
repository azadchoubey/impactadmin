<?php

namespace App\Livewire;

use App\Models\Picklist;
use App\Models\Pubmaster;
use Livewire\Component;
use Livewire\WithFileUploads;
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
    public $circulation = '';
    public $RatePC;
    public $RatePB;
    public $RateNC;
    public $RateNB;
    public $masthead;
    public $checkboxes =[];
    protected $rules = [
        'title' => 'required',
        'edition'=>'required',
        'category'=>'required',
        'region'=>'required',
        'language'=>'required'
    ];
    protected $messages = [
        'title.required' => 'The Name cannot be empty.',
        'category.required' => 'The category cannot be empty.',
        'region.required' => 'The region cannot be empty.',
        'language.required' => 'The language cannot be empty.'

    ];
    public function render()
    {
        $data = Picklist::whereIn('Type',['Region','Language','Pub Category','Pubtype'])->get()->groupBy('Type');
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
        dd($this->checkboxes);
       $validatedData = $this->validate();
        Pubmaster::insert([
            'PrimaryPubID' => $this->primary??0,
            'Title' => $this->title,
            'place' => $this->edition,
            'Category' => $this->category,
            'Type' => $this->type,
            'Region' => $this->region,
            'Language' => $this->language,
            // 'restrictedmu' => $this->restrictedmu,
            // 'mu' => $this->mu,
            'MastHead' => $this->masthead->store('photos'),
            'Circulation' => $this->circulation,
            'Issn_Num' => $this->issn,
            // 'frequency' => $this->frequency,
            'Size' => $this->size,
            'RatePC' => $this->RatePC,
            'RateNC' => $this->RateNC,
            'RatePB' => $this->RatePB,
            'RateNB' => $this->RateNB,
            'CreateDateTime'=>now(),
            'EditDateTime'=>now()
        ]);
        
        Log::info('created new publication name: {name} by user: {user} ',['name'=>$this->title,'user'=>auth()->user()->UserID]);
        session()->flash('success', 'Record Added successfully!');
        return redirect()->to('/publications');
    }
}
