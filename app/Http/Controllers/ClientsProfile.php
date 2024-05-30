<?php

namespace App\Http\Controllers;

use App\Models\Bmdeliverymethod;
use App\Models\ClinetContacts;
use App\Models\Clinetprofile;
use App\Models\ContactSector;
use App\Models\CustomDigestFormat;
use App\Models\Deliverymethod1;
use App\Models\Deliverymethod;
use App\Models\Deliverymethodmaster;
use App\Models\Mongo\ClientContact;
use App\Models\Picklist;
use App\Models\Wmwebdeliverymethod;
use App\Models\Wmwebdeliverymethodmaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Log;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class ClientsProfile extends Controller
{
    public function index($id)
    {
        $data = Clinetprofile::with('contacts', 'contacts.delivery', 'contacts.delivery.deliveryformats', 'contacts.regularDigestPrint', 'contacts.regularDigestWeb', 'Country', 'Region', 'sector', 'keywords', 'billingcycle')->find(base64_decode($id));

        $keywords = $data->keywords;
        $contacts = $data->contacts;
        $picklist = Picklist::whereIn('Type', ['City', 'Country', 'Delivery Method', 'Sector Summary Delivery', 'contacttype','client type','client source','Region','bill cycle','client status','sector'])->get()->groupBy(function ($query) {
            return strtolower($query->Type);
        });
        $webdeliverymaster = Wmwebdeliverymethodmaster::all();
        $deliverymaster = Deliverymethodmaster::all();
        $clients = Clinetprofile::where('deleted','!=',1)->get();
        $formats = CustomDigestFormat::select('id','format_name')->get();
        $customdelivery = Deliverymethod1::select('id','contactid','deliveryid','format')->get();
        return view('clients', compact('data', 'contacts', 'keywords', 'picklist', 'webdeliverymaster', 'deliverymaster','clients','formats','customdelivery'));
    }

    public function edit(Request $request, $id)
    {
        $request->validate(['Name'  => 'required',
        'Currency'  => 'alpha',
        'Mobile'  => 'regex:/^[0-9]{10}$/',
    ],
   );
        $clientProfile = Clinetprofile::findOrFail($id);
        try{
            $clientProfile->Name = $request->Name;
            $clientProfile->broadcastcid = $request->broadcastid;
            $clientProfile->PriClientID = $request->primary_client_id??'';
            $clientProfile->SectorPid = $request->SectorPid??0;
            $clientProfile->Mobile = $request->Mobile;
            $clientProfile->Reference = $request->reference??0;
            $clientProfile->StartDate = $request->StartDate??'0000-00-00';
            $clientProfile->EndDate = $request->EndDate??'0000-00-00';
            $clientProfile->BillDate = $request->BillDate??'0000-00-00';
            $clientProfile->Currency = $request->Currency;
            $clientProfile->Type = $request->Type;
            $clientProfile->Region = $request->Region??0;
            $clientProfile->wm_enableforprint = $request->wm_enableforprint??0;
            $clientProfile->BillCycleID = $request->BillCycleID??0;
            $clientProfile->BillRate = $request->BillRate??0;
            $clientProfile->Status = $request->Status??0;
            $clientProfile->wm_enableforweb = $request->wm_enableforweb??0;
            $clientProfile->wm_contractstartdate = $request->wm_contractstartdate??'0000-00-00';
            $clientProfile->wm_contractenddate = $request->wm_contractenddate??'0000-00-00';
            $clientProfile->wm_billingcycle = $request->wm_billingcycle??0;
            $clientProfile->wm_billingdate = $request->wm_billingdate??'0000-00-00';
            $clientProfile->wm_billingrate = $request->wm_billingrate??0;
            $clientProfile->wm_status = $request->wm_status??0;
            $clientProfile->wm_enablefortwitter = $request->wm_enablefortwitter??0;
            $clientProfile->wm_twitter_contractstartdate = $request->wm_twitter_contractstartdate;
            $clientProfile->wm_twitter_contractenddate = $request->wm_twitter_contractenddate;
            $clientProfile->wm_twitter_status = $request->wm_twitter_status??0;
            $clientProfile->enableforwhatsapp = $request->enableforwhatsapp??0;
            $clientProfile->enableforyoutube = $request->enableforyoutube??0;
            $clientProfile->enablefordidyounotice = $request->enablefordidyounotice??0;
            $clientProfile->enableforfulltext = $request->enableforfulltext??0;
            $clientProfile->EditDateTime=now();
            $clientProfile->Edit_By=auth()->user()->UserID;
            if ($request->hasFile('Logo')) {
              
                $filename = $request->file('Logo')->getClientOriginalName();
                $request->file('Logo')->storeAs('client', $filename);
                $clientProfile->Logo = $filename;
            }
            $clientProfile->update();
            Log::info('Record updated client name: {name} and clientid: {clientid} by user: {user} ',['clientid'=>$id,'user'=>auth()->user()->UserID,'name'=>$request->Name]);
            return redirect()->route('clients', ['id' => base64_encode($id)])->with('success', 'Client profile updated successfully.');

        }catch(Exception $e){
            Log::error('Error while creating clientprofile: {error}', ['error' => $e->getMessage()]);
            session()->flash('error', 'An error occurred while adding the record.');
            return redirect()->back();
        }
       

    }
    public function addclient()
    {
        $clients = Clinetprofile::where('deleted', '!=', 1)->get();
        $picklist = Picklist::whereIn('Type', ['City', 'Country', 'Bill Cycle', 'Sector', 'State', 'Client Status', 'Region', 'Client Type', 'Client Source', 'subsector'])->get()->groupBy(function ($query) {
            return strtolower($query->Type);
        });
        return view('createcilent', compact('clients', 'picklist'));
    }
    public function getDeliveryTimes(Request $request)
    {

        $deliveryTimes = Deliverymethod1::where(['format'=> $request->id,'contactid'=>$request->contactid])->pluck('deliveryid');

        return response()->json($deliveryTimes);
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

    public function addcontact(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'ContactName' => 'required|string',
            'Mobile' => 'required|digits:10',
            'Email' => 'required|email',
            'Address1' => 'required',
            'Address2' => 'required',
            'Address3' => 'required',
            'CountryID' => 'required',
            'CityID' => 'required',
            'Designation' => 'required',
            'CountryCode' => 'required',
            'Pin' => 'required',
            'Fax' => 'required',
            'Company' => 'required',
            'Phone' => 'required',
        ], [
            'CountryID.required' => 'Country field is required',
            'CityID.required' => 'City field is required',
            'Mobile.required' => 'Mobile must be 10 digits.',
            'Email.required' => 'Please enter a valid email address.',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
    
        try {
            DB::beginTransaction();
    
            $deliveryids = $request->only('deliveryid');
            $sectorids = $request->only('SectorID');
            $format = $request->only('format');
            $wm_deliverymethod =  $request->only('wm_deliveryids');
            $broadcast = $request->broadcast;
            $deliverymethod = $request->only('deliverymethod'); 
            $input = $request->except(['_token', 'deliveryid', 'SectorID', 'format', 'wm_deliveryids', 'deliverymethod']);
            $input['ContactType'] = 0; 
            $input['wm_deliverymethod'] = $request->wm_enableforweb ? 1 : 0;
            $contactid = ClinetContacts::insertGetId($input);
    
            // Generate a 6-7 digit random password
            $password = str_pad(rand(0, 9999999), 6, '0', STR_PAD_LEFT);
    
            if ($contactid) {
                // Update the newly created contact with userid and passwd
                ClinetContacts::where('contactid', $contactid)->update([
                    'userid' => $contactid,
                    'passwd' => $password,
                ]);
    
                if ($wm_deliverymethod) {
                    $wm_webdeliverymethod = [];
                    foreach ($wm_deliverymethod['wm_deliveryids'] as $SectorID) {
                        $wm_webdeliverymethod[] = ['deliveryid' => $SectorID, 'contactid' => $contactid];
                    }
                    Wmwebdeliverymethod::insert($wm_webdeliverymethod);
                }
                if ($sectorids) {
                    $contact_sector = [];
                    foreach ($sectorids['SectorID'] as $SectorID) {
                        $contact_sector[] = ['SectorID' => $SectorID, 'ContactID' => $contactid];
                    }
                    ContactSector::insert($contact_sector);
                }
    
                if (isset($input['wm_deliverymethod'])&& $input['wm_deliverymethod'] == 1) {
                    foreach ($deliveryids['deliveryid'] as $deliveryid) {
                        Deliverymethod1::insert([
                            'contactid' => $contactid,
                            'deliveryid' => $deliveryid,
                            'format' => $format['format'],
                        ]);
                    }
                }                
                if (isset($input['wm_enableforprint']) && $input['wm_enableforprint'] == 1) {
                    foreach ($deliverymethod['deliverymethod'] as $deliveryid) {
                        Deliverymethod::insert([
                            'contactid' => $contactid,
                            'deliveryid' => $deliverymethod['deliverymethod'],
                        ]);
                    }
                }
    
                DB::commit();
                $client = Clinetprofile::find($input['clientid']);
                ClientContact::insert([
                    'Client_Name' => $client->Name,
                    'ContactName' => $input['ContactName'],
                    'Email' => $input['Email'],
                    'ClientId' => $input['clientid'],
                    'contactid' => $contactid,
                    'deliverytime' => '',
                    'deliverytime_web_automated' => '',
                    'deliverytime_Print_automated' => '',
                    'enableforqlikview' => 0,
                    'wm_enableforprint' => $request->wm_enableforprint ? 1 : 0,
                    'wm_enableforweb' => $request->wm_enableforweb ? 1 : 0,
                    'dashboard' => $request->dashboard ? 1 : 0,
                    'enableforbr' => $request->enableforbr ? 1 : 0,
                    'enableforwhatsapp' => $request->enableforwhatsapp ? 1 : 0,
                    'whatsappnumber' => $request->whatsappnumber ? $request->whatsappnumber : '',
                    'enableformediatouch' => $request->enableformediatouch ? 1 : 0,
                    'enablefordidyounotice' => $request->enablefordidyounotice ? 1 : 0,
                    'client_status' => 'Active',
                    'wm_client_status' => "Active"
                ]);
                Log::info('created new client contact: {name} and contactid: {contactid} by user: {user} ', ['contactid' => $contactid, 'user' => auth()->user()->UserID, 'name' => $input['ContactName']]);
                session()->flash('success', 'Contact Added Successfully!');
                return response()->json(['success' => true]);
            } else {
                DB::rollback();
                session()->flash('error', 'Operation Failed!');
                return response()->json(['error' => 'Operation Failed!'], 500);
            }
        } catch (Exception $e) {
            DB::rollback();
            Log::error('Error while creating clientprofile: {error}', ['error' => $e->getMessage()]);
            session()->flash('error', 'Operation Failed!');
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    public function editContact(Request $request)
{
    $validator = Validator::make($request->all(), [
        'ContactName' => 'required|string',
        'Mobile' => 'required|digits:10',
        'Email' => 'required|email',
        'Address1' => 'required',
        'Address2' => 'required',
        'Address3' => 'required',
        'CountryID' => 'required',
        'CityID' => 'required',
        'Designation' => 'required',
        'CountryCode' => 'required',
        'Pin' => 'required',
        'Fax' => 'required',
        'Company' => 'required',
        'Phone' => 'required',
    ],[
        'CountryID.required'=>'Country field is required',
        'CityID.required'=>'City field is required',
        'Mobile.required' => 'Mobile must be 10 digits.',
        'Email.required' => 'Please enter a valid email address.',
    ]);

    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()]);
    }
    try {
        DB::beginTransaction();
        $contactId = $request->contactid;
        $deliveryIds = $request->only('deliveryid');
        $sectorIds = $request->only('SectorID');
        $format = $request->only('format');
        $wmDeliveryMethod = $request->only('wm_deliveryids');
        $deliveryMethod = $request->only('deliverymethod');
        $input = $request->except(['_token', 'contactid', 'deliveryid', 'SectorID', 'format', 'wm_deliveryids', 'deliverymethod']);
        $input['ContactType'] = 0;
        $input['wm_deliverymethod'] = $request->wm_enableforweb ? 1 : 0;
        $input['enableformediatouch'] = $request->enableformediatouch ? 1 : 0;
        $input['enablefortwitter'] = $request->enablefortwitter ? 1 : 0;
        $input['enableformobile'] = $request->enableformobile ? 1 : 0;
        $input['enableforqlikview'] = $request->enableforqlikview ? 1 : 0;

        ClinetContacts::where('ContactID', $contactId)->update($input);

        if ($wmDeliveryMethod) {
            Wmwebdeliverymethod::where('contactid', $contactId)->delete();

            $wmWebDeliveryMethod = [];
            foreach ($wmDeliveryMethod['wm_deliveryids'] as $sectorId) {
                $wmWebDeliveryMethod[] = ['deliveryid' => $sectorId, 'contactid' => $contactId];
            }
            Wmwebdeliverymethod::insert($wmWebDeliveryMethod);
        }

        if ($sectorIds) {
            ContactSector::where('ContactID', $contactId)->delete();

            $contactSector = [];
            foreach ($sectorIds['SectorID'] as $sectorId) {
                $contactSector[] = ['SectorID' => $sectorId, 'ContactID' => $contactId];
            }
            ContactSector::insert($contactSector);
        }

        if (isset($input['wm_deliverymethod']) && $input['wm_deliverymethod'] == 1 && $deliveryIds) {
            // Check if there are existing records for the contactid and format
            $existingRecords = Deliverymethod1::where('contactid', $contactId)->where('format', $format['format'])->get();
        
            if ($existingRecords->isNotEmpty()) {
                // If existing records are found, delete them
                Deliverymethod1::where('contactid', $contactId)->where('format', $format['format'])->delete();
            }
        
            // Insert new records for each deliveryId
            foreach ($deliveryIds['deliveryid'] as $deliveryId) {
                Deliverymethod1::insert([
                    'contactid' => $contactId,
                    'deliveryid' => $deliveryId,
                    'format' => $format['format'],
                ]);
            }
        } else {
            // Handle the case where the conditions are not met, or provide alternative logic
        }
        

        if (isset($input['wm_enableforprint']) && $input['wm_enableforprint'] == 1 && $deliveryMethod) {
            Deliverymethod::where('contactid', $contactId)->delete();
            foreach ($deliveryMethod['deliverymethod'] as $deliveryId) {
                Deliverymethod::insert([
                    'contactid' => $contactId,
                    'deliveryid' => $deliveryId,
                ]);
            }
        }

        DB::commit();

        Log::info('Updated client contact: {name} and contactid: {contactid} by user: {user}', [
            'contactid' => $contactId,
            'user' => auth()->user()->UserID,
            'name' => $input['ContactName']
        ]);
        session()->flash('success', 'Contact Updated Successfully!');
        return response()->json(['success' => true]);
    } catch (Exception $e) {
        DB::rollback();
        Log::error('Error while updating client contact: {error}', ['error' => $e->getMessage()]);
        session()->flash('error', 'Operation Failed!');
        return response()->json(['error' => $e->getMessage()], 500);
    }
}

    
}
