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
    public $clientshow = true;
    public $contacts;
    public $keywords = [];
    public $id ,$selectAll = false,$checkboxes,$cont;
    public $activeTab = 'profile',$page = 10,$broadcastCheckbox,$broadcast,$primaryCheckbox,$primary; 
    private $editing;
   public function mount(){
    $this->id = request()->route()->parameter('id');
    $this->clientsubmit();
   }
    public function switchTab($tabName)
    {
        $this->activeTab = $tabName;
    }

    public function toggleSelectAll($contacts)
    {
        //dd($contacts);
        $this->selectAll = !$this->selectAll;

        foreach ($contacts  as $contact) {
            $this->checkboxes[$contact['contactid']] = $this->selectAll;
        }
    }
    public function startEditing($clientId)
    {
        $this->editing = $clientId;
       
    }

    public function updateClient($clientId)
    {
       
        $this->editing = null; 
    }

    public function render()
    {
      
        return view('livewire.client-profile');
    }
    public function updateCheckbox($contactid){
        $this->checkboxes[$contactid] = !$this->checkboxes[$contactid] ;
    }
    public function fetchAll($id,$name){
        $this->clientshow = false;
        $this->name = $name;
        $this->id = $id;
        $this->clientsubmit();
    }
    public function clientsubmit(){
        $data = Clinetprofile::with('contacts.delivery','contacts.regularDigestPrint','contacts.regularDigestWeb','Country','region','sector')->find($this->id);
        $this->clientID = $data->ClientID;
        $this->csrsince = $data->customersince;
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
        $this->checkboxes = array_fill_keys($this->contacts->contacts->pluck('contactid')->toArray(), false);  
        $this->sector = $data->sector->Name;
        $this->client =$data->Logo;
      
    }
}
