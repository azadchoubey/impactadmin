<?php

namespace App\Http\Controllers;

use App\Livewire\ClientProfile;
use App\Models\ClinetContacts;
use App\Models\Clinetprofile;
use App\Models\ContactSector;
use App\Models\Deliverymethodmaster;
use App\Models\Picklist;
use App\Models\Wmwebdeliverymethod;
use App\Models\Wmwebdeliverymethodmaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Log;

class ClientsProfile extends Controller
{
    public function index($id)
    {
        $data = Clinetprofile::with('contacts', 'contacts.delivery', 'contacts.regularDigestPrint', 'contacts.regularDigestWeb', 'Country', 'Region', 'sector', 'keywords', 'billingcycle')->find(base64_decode($id));
        $keywords = $data->keywords;
        $contacts = $data->contacts;
        $picklist = Picklist::whereIn('Type', ['City', 'Country', 'Delivery Method', 'Sector Summary Delivery', 'contacttype','client type','client source','Region','bill cycle','client status'])->get()->groupBy(function ($query) {
            return strtolower($query->Type);
        });
        $webdeliverymaster = Wmwebdeliverymethodmaster::all();
        $deliverymaster = Deliverymethodmaster::all();
        $clients = Clinetprofile::where('deleted','!=',1)->get();
        return view('clients', compact('data', 'contacts', 'keywords', 'picklist', 'webdeliverymaster', 'deliverymaster','clients'));
    }

    public function edit(Request $request, $id)
    {
        $request->validate([
            'Name'  => 'required',
            'currency'  => 'required',
            'Mobile'  => 'required',
            'Email'  => 'required',
            'StartDate'  => 'required',
        ]);
        $clientProfile = Clinetprofile::findOrFail($id);
        $clientProfile->Name = $request->Name;
        $clientProfile->broadcastcid = $request->broadcast;
        $clientProfile->customersince = $request->csrsince;
        $clientProfile->Mobile = $request->Mobile;
        $clientProfile->Reference = $request->reference;
        $clientProfile->contractstart = $request->StartDate;
        $clientProfile->billingdate = $request->BillDate;
        $clientProfile->Currency = $request->currency;
        $clientProfile->update();

        return redirect()->route('client.profile', ['id' => $id])->with('success', 'Client profile updated successfully.');
    }
    public function addclient()
    {
        $clients = Clinetprofile::where('deleted', '!=', 1)->get();
        $picklist = Picklist::whereIn('Type', ['City', 'Country', 'Bill Cycle', 'Sector', 'State', 'Client Status', 'Region', 'Client Type', 'Client Source', 'subsector'])->get()->groupBy(function ($query) {
            return strtolower($query->Type);
        });
        return view('createcilent', compact('clients', 'picklist'));
    }
    
    public function getSubsectors($industry)
    {
        $subsectors = Picklist::select('ID', 'Name')
            ->where('Type', 'subsector')
            ->where('SubType', $industry)
            ->get();

        return response()->json($subsectors);
    }
    public function create(Request $request)
    {

        $request->validate([
            'Name'  => 'required',
            'Currency'  => 'required|alpha',
            'Mobile'  => 'required|regex:/^[0-9]{10}$/',
            'Source' => 'required',
            'Region'=> 'required',
            'SectorPid'=>'required',
            'Type'=>'required',
        ],
        [
            'SectorPid.required' => 'Industory / Sector field is required',
            'Source.required' => 'Reference field is required',
        ]
    );

    try{
        DB::beginTransaction();
        $input = $request->except(['_token']);
       
        if ($request->hasFile('Logo')) {
            $filename = $request->file('Logo')->getClientOriginalName();
            $request->file('Logo')->storeAs('client', $filename);
            $input['Logo'] = $filename;
        }
        $s2 = strtoupper(substr($request->Name, 0, 1));
        $clientid = '';

        $maxClientId = Clinetprofile::where('ClientID', 'LIKE', $s2 . '%')->max('ClientID');
        if (!$maxClientId) {
            $clientid = $s2 . '0001';
        } else {
            $maxNumber = (int)substr($maxClientId, 1);
            $a = $maxNumber + 1;
            $clientid = $s2 . str_pad($a, 4, '0', STR_PAD_LEFT);
        }
        
        $input['ClientID']= $clientid;
        $input['Edit_By']= auth()->user()->UserID;
        if ( !$input['StartDate']) {
            unset($input['StartDate']);
        }
        if ( !$input['EndDate']) {
            unset($input['EndDate']);
        }
        if ( !$input['BillCycleID']) {
            unset($input['BillCycleID']);
        }
        if ( !$input['Status']) {
            unset($input['Status']);
        }
        Clinetprofile::insert($input);
        Log::info('created new client name: {name} and clientid: {clientid} by user: {user} ',['clientid'=>$clientid,'user'=>auth()->user()->UserID,'name'=>$input['Name']]);
        return redirect('clients')->with('success', 'Client Added successfully.');
    }catch(Exception $e){
        Log::error('Error while creating clientprofile: {error}', ['error' => $e->getMessage()]);
        session()->flash('error', 'An error occurred while adding the record.');

       }
    }
    public function addcontact(Request $request){
        $validator = Validator::make($request->all(), [
            'ContactName' => 'required|string',
            'Mobile' => 'required',
            'Email' => 'required|email',
            'Address1' => 'required',
            'Address2' => 'required',
            'Address3' => 'required',
            'CountryID' => 'required',
            'CityID' => 'required',
        ],[
            'CountryID.required'=>'Country field is required',
            'CityID.required'=>'City field is required',
        ]);
        
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        
        try {
            DB::beginTransaction();
        
            $deliveryids = $request->only('deliveryid');
            $sectorids = $request->only('SectorID');
            $input = $request->except(['_token','deliveryid','SectorID']);
            $input['ContactType'] = 0; 
            $contactid = ClinetContacts::insertGetId($input);
        
            if ($contactid) {
                if ($deliveryids) {
                    $wm_webdeliverymethod = [];
                    foreach ($deliveryids['deliveryid'] as $SectorID) {
                        $wm_webdeliverymethod[] = ['deliveryid'=>$SectorID,'contactid'=>$contactid];
                    }
                    Wmwebdeliverymethod::insert($wm_webdeliverymethod);
                }
                if ($sectorids) {
                    $contact_sector = [];
                    foreach ($sectorids['SectorID'] as $SectorID) {
                        $contact_sector[] = ['SectorID'=>$SectorID,'ContactID'=>$contactid];
                    }
                    ContactSector::insert($contact_sector);
                }
        
                DB::commit();
        
                session()->flash('success', 'Contact Added Successfully!');
                return response()->json(['success' => true]);
            } else {
                DB::rollback();
                session()->flash('error', 'Operation Failed!');
                return response()->json(['error' => 'Operation Failed!'], 500);
            }
        } catch (\Exception $e) {
            DB::rollback();
            session()->flash('error', 'Operation Failed!');
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }
}
