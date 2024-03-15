<?php

namespace App\Http\Controllers;

use App\Models\Clinetprofile;
use App\Models\Deliverymethodmaster;
use App\Models\Picklist;
use App\Models\Wmwebdeliverymethodmaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ClientsProfile extends Controller
{
    public function index($id)
    {
        $data = Clinetprofile::with('contacts', 'contacts.delivery', 'contacts.regularDigestPrint', 'contacts.regularDigestWeb', 'Country', 'region', 'sector', 'keywords','billingcycle')->find($id);;
        $keywords = $data->keywords;
        $contacts = $data->contacts;
        $editing = '';
        $picklist = Picklist::whereIn('Type',['City','Country','Delivery Method','Sector Summary Delivery','contacttype'])->get()->groupBy('Type');
        $webdeliverymaster = Wmwebdeliverymethodmaster::all();
        $deliverymaster = Deliverymethodmaster::all();
        return view('clients', compact('data', 'contacts', 'keywords', 'editing','picklist','webdeliverymaster','deliverymaster'));
    }
    public function edit(Request $request, $id)
    {
        $request->validate([
          'address1'  =>'required',
          'Name'  =>'required',
          'City'  =>'required',
          'state'  =>'required',
          'pincode'  =>'required',
          'currency'  =>'required',
          'Mobile'  =>'required',
          'Email'  =>'required',
          'StartDate'  =>'required',
          'contractend'  =>'required'

        ]);
        // Retrieve the client profile data
        $clientProfile = Clinetprofile::findOrFail($id);
        $clientProfile->Name=$request->Name;
        $clientProfile->broadcastcid=$request->broadcast;
        $clientProfile->customersince=$request->csrsince;
        $clientProfile->Phone=$request->Phone;
        $clientProfile->AddressLine1=$request->address1;
        $clientProfile->Fax=$request->Fax;
        $clientProfile->AddressLine2=$request->address2;
        $clientProfile->Mobile=$request->Mobile;
        $clientProfile->AddressLine3=$request->address3;
        $clientProfile->Email=$request->Email;
        $clientProfile->Reference=$request->reference;
        $clientProfile->City=$request->City;
        $clientProfile->contractstart=$request->StartDate;
        $clientProfile->State=$request->state;
        $clientProfile->Pin=$request->pincode;
        $clientProfile->EndDate=$request->contractend;
        $clientProfile->billingdate=$request->BillDate;
        $clientProfile->Currency=$request->currency;
        // Update the client profile with the new data
        $clientProfile->update();

        // Redirect back to the client profile page or any other desired route
        return redirect()->route('client.profile', ['id' => $id])->with('success', 'Client profile updated successfully.');
    }
}
