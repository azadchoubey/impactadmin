<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Clinetprofile;
use Livewire\WithPagination;
class ClientProfile extends Component
{
    use WithPagination;
    public $clientID, $name, $AddressLine1,  $AddressLine2, $AddressLine3, $city, $state, $pincode, $country, $currency;
    public $phone, $fax, $mobile, $email;
    public $contractstart, $contractend, $printstatus, $region, $webstatus;
    public $csrsince, $industrySector, $sector, $subsector;
    public $reference, $type, $billingcycle, $billingdate, $billingrate,$client;

    public $clientshow = false;
    public $Results = [];
    public $contacts;
    public $keywords = [];
    public $id;
    public function mount()
    {
    }
    public function render()
    {
        return view('livewire.client-profile');
    }
    public function updateTitle(){
        $this->clientshow = false;

        if(strlen($this->name) >= 2){ 
            $this->Results = Clinetprofile::where('Name','LIKE','%'.$this->name.'%')
            ->get(['ClientID','Name']);
        } else {
            $this->Results = [];
        }
    }
    public function fetchAll($id,$name){
        $this->Results = [];
        $this->name = $name;
        $this->id = $id;
    }
    public function clientsubmit(){
        $this->clientshow = true;
        $data = Clinetprofile::with('contacts.delivery','contacts.regularDigestPrint','contacts.regularDigestWeb','Country','region','sector')->find($this->id);
     //dd($data->contacts[16]);
        $this->clientID = $data->ClientID;
        $this->csrsince = $data->csrsince;
        $this->phone = $data->Phone;
        $this->AddressLine1 = $data->AddressLine1;
        $this->AddressLine2 = $data->AddressLine2;
        $this->AddressLine3 = $data->AddressLine3;
        $this->mobile = $data->Mobile;
        $this->email = $data->Email;
        $this->city = $data->city;
        $this->contractstart = $data->wm_contractstartdate;
        $this->contractend = $data->wm_contractenddate;
        $this->state = $data->State;
        $this->pincode = $data->Pin;
        $this->country =$data->Country->Name;
        $this->printstatus =$data->wm_enableforprint;
        $this->currency =$data->currency;
        $this->region =$data->region->Name;
        $this->webstatus =$data->wm_enableforweb;
        $this->reference =$data->Reference;
        $this->type =$data->type->Name;
        $this->billingcycle =$data->billingcycle->Name;
        $this->billingdate =$data->wm_billingdate;
        $this->billingrate =$data->wm_billingrate;
        $this->contacts = $data;
        $this->sector = $data->sector->Name;
    }
}
