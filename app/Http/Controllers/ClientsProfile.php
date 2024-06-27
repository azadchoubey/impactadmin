<?php

namespace App\Http\Controllers;

use App\Livewire\ClientProfile;
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
use App\Models\Pubmaster;
use App\Models\Wmwebdeliverymethod;
use App\Models\Wmwebdeliverymethodmaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ClientDetailsExport;
use App\Exports\BrandStringsExport;
use App\Exports\ClientsExport;
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
    
            $password = str_pad(rand(0, 9999999), 6, '0', STR_PAD_LEFT);
    
            if ($contactid) {
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
public function downloadMediaUniverseReport(Request $request)
    {
        $clientId = $request->query('clid');
        $newxls = md5(uniqid(rand(), true)) . ".csv";
        $headers = [
            "Content-Disposition" => "attachment; filename=" . $newxls,
            'Content-Type' => 'application/ms-excel',
        ];

        $sql = "
            SELECT pm.title as t, pm.type as ty, pl.Name as p, pll.name as lang, pm.Circulation as Circulation, pm.pubid as pid
            FROM media_universe_master m
            INNER JOIN pub_master pm ON m.pubid = pm.pubid
            INNER JOIN picklist pl ON pm.Place = pl.ID
            JOIN picklist pll ON pm.language = pll.id
            WHERE m.clientId = ? AND pm.PrimaryPubID = 0 AND (pm.type = 230 OR pm.type = 229)
            ORDER BY t, pm.type DESC, p ASC
        ";

        $results = DB::connection('mysql2')->select($sql, [$clientId]);
        
        $clientProfile = Clinetprofile::where('clientid', $clientId)->first();
        $clientName = $clientProfile ? $clientProfile->Name : 'Unknown';

        $contentsNews = "Media Universe For: " . $clientName . " (" . $clientId . ")\n";
        $contentsNews .= "Publication,Edition,Language,Circulation,Pubid,Type\n";

        foreach ($results as $row) {
            $contentsNews .= strip_tags($row->t) . ",";
            $contentsNews .= strip_tags($row->p) . ",";
            $contentsNews .= strip_tags($row->lang) . ",";
            $contentsNews .= strip_tags($row->Circulation) . ",";
            $contentsNews .= strip_tags($row->pid) . ",";
            $contentsNews .= ($row->ty == 230) ? "Newspaper\n" : "Magazine\n";
        }

        $contentsNews = strip_tags($contentsNews);

        return Response::make($contentsNews, 200, $headers);
    }
    public function searchExceptional(Request $request)
    {
        $newsNMag = trim($request->input('newsNMag'));
        $searchCriteria = $request->input('searchCriteria', 'name');
        $selectedNewsIds = $request->input('newsPaper', []);
        $selectedMagIds = $request->input('magzine', []);

        $condition = ($searchCriteria == 'name') ? "pub_master.Title LIKE '{$newsNMag}%'" : "picklist.Name LIKE '{$newsNMag}%'";

        // Fetch newspapers
        $newsPublications = $this->fetchPublicationsByType(230, $condition, $selectedNewsIds);
        // Fetch magazines
        $magazinePublications = $this->fetchPublicationsByType(229, $condition, $selectedMagIds);

        $arrResult = [
            "news" => $newsPublications,
            "magazine" => $magazinePublications,
        ];

        return response()->json($arrResult);
    }

    private function fetchPublicationsByType($type, $condition, $selectedIds)
    {
        $query = DB::table('pub_master')
            ->select('pub_master.Title as Name', 'pub_master.PubId as ID', 'picklist.Name as ediPlace', 'pub_master.IsMain')
            ->join('picklist', 'pub_master.Place', '=', 'picklist.ID')
            ->where('pub_master.PrimaryPubId', 0)
            ->where('pub_master.type', $type)
            ->where('pub_master.deleted', 0)
            ->whereRaw($condition);

        if (!empty($selectedIds) && $selectedIds[0] != -420) {
            $query->whereNotIn('pub_master.PubId', $selectedIds);
        }

        $publications = $query->orderBy('Name')
                             ->get();

        $result = '<select size="4" name="' . ($type == 230 ? 'newspaper' : 'magzine') . '" style="width:200px;" id="' . ($type == 230 ? 'newspaper' : 'magzine') . '" multiple="multiple">';
        foreach ($publications as $publication) {
            $style = ($publication->IsMain == 1) ? 'style="background-color:yellow;"' : '';
            $result .= '<option value="' . $publication->ID . '" ' . $style . '>' . $publication->Name . ' (' . $publication->ediPlace . ')</option>';
        }
        $result .= '</select>';

        if ($publications->isEmpty()) {
            $result = '<select size="4" name="' . ($type == 230 ? 'newspaper' : 'magzine') . '" style="width:200px;" id="' . ($type == 230 ? 'newspaper' : 'magzine') . '" multiple="multiple"><option>No record found</option></select>';
        }

        return $result;
    }
    
    public function addComment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'addcomment' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validation failed', 'errors' => $validator->errors()], 400);
        }
        $clientId = $request->input('clientid');
        $user = auth()->user()->UserID;
        $addcomment = $request->input('addcomment');

        DB::table('MUComment')->insert([
            'clientid' => $clientId,
            'comment' => $addcomment,
            'user' => $user,
            'createddatetime' => now()
        ]);

        session()->flash('success', 'Comment Added Successfully!');


        return response()->json(['status' =>true]);
    }
    public function export()
    {
        $data = DB::table('clientcontacts')
            ->select(
                'clientcontacts.ContactName as contactname',
                'clientcontacts.Email as email',
                'clientprofile.Name as name',
                DB::raw("(case when(clientcontacts.wm_enableforweb=1) then 'Yes' else ' ' end) as webenable"),
                DB::raw("(case when(clientcontacts.wm_enableforprint=1) then 'Yes' else ' ' end) as printenable"),
                DB::raw("(case when(clientcontacts.enableforbr=1) then 'Yes' else ' ' end) as brenable"),
                DB::raw("(case when(clientcontacts.enableforqlikview=1) then 'Yes' else ' ' end) as smartmeasure"),
                DB::raw("(case when(clientcontacts.dashboard=1) then 'Yes' else ' ' end) as smartdashboard"),
                DB::raw("if(picklist.Name='Digest- Broadcast - Every 24 Hours','Digest- Broadcast - Every 24 Hours','') as broadcast"),
                DB::raw("if(picklist.Name<>'Digest- Broadcast - Every 24 Hours',picklist.Name,'') as printdigest"),
                DB::raw("group_concat(SUBSTRING(wm_webdeliverymethod_master.deliverytime,1,2) ORDER BY wm_webdeliverymethod_master.deliverytime ASC) as webtime")
            )
            ->leftJoin('wm_webdeliverymethod', 'wm_webdeliverymethod.contactid', '=', 'clientcontacts.contactid')
            ->leftJoin('wm_webdeliverymethod_master', 'wm_webdeliverymethod_master.id', '=', 'wm_webdeliverymethod.deliveryid')
            ->leftJoin('clientprofile', 'clientprofile.ClientID', '=', 'clientcontacts.ClientID')
            ->leftJoin('picklist', 'picklist.id', '=', 'clientcontacts.DeliveryID')
            ->where(function($query) {
                $query->where('clientprofile.status', 366)
                      ->orWhere('clientprofile.wm_status', 366);
            })
            ->where(function($query) {
                $query->where('clientcontacts.wm_enableforweb', 1)
                      ->orWhere('clientcontacts.wm_enableforprint', 1)
                      ->orWhere('clientcontacts.enableforbr', 1);
            })
            ->where('clientprofile.deleted', '<>', 1)
            ->groupBy(
                'clientcontacts.ClientID',
                'clientcontacts.ContactName',
                'clientcontacts.Email',
                'clientprofile.Name'
            )
            ->get();

        $filename = "Clientlist.xlsx";
        
        return Excel::download(new ClientsExport($data), $filename);
    }
    public function exportDetails()
    {
        $data = DB::table('clientprofile')
            ->select(
                'c1.Name as primaryc',
                'clientprofile.Name as name',
                'clientprofile.AddressLine1 as address1',
                'clientprofile.AddressLine2 as address2',
                'clientprofile.AddressLine3 as address3',
                'clientprofile.City as city',
                'clientprofile.State as state',
                'clientprofile.Pin as pin',
                'clientprofile.Currency as currency',
                'p1.Name as clientsource',
                'p2.Name as print',
                'p3.Name as web',
                
                'p4.Name as region',
                'p5.Name as billcycle',
                'clientprofile.BillDate as billdate',
                'clientprofile.BillRate as billrate',
                'p6.Name as Sector',
                'clientprofile.StartDate as startdate',
                'clientprofile.endDate as enddate',
                'p7.Name as type',

                'clientprofile.broadcastcid as broadcastcid',
            )
            ->leftJoin('picklist as p1', 'p1.id', '=', 'clientprofile.Source')
            ->leftJoin('picklist as p2', 'p2.id', '=', 'clientprofile.status')
            ->leftJoin('picklist as p3', 'p3.id', '=', 'clientprofile.wm_status')
            ->leftJoin('picklist as p4', 'p4.id', '=', 'clientprofile.Region')
            ->leftJoin('picklist as p5', 'p5.id', '=', 'clientprofile.BillCycleID')
            ->leftJoin('picklist as p6', 'p6.id', '=', 'clientprofile.SectorPid')
            ->leftJoin('picklist as p7', 'p7.id', '=', 'clientprofile.Type')
            ->leftJoin('clientprofile as c1', 'clientprofile.PriClientID', '=', 'c1.ClientID')
            ->where('clientprofile.deleted', '!=', 1)
            ->get()
            ->map(function($row) {
                $row->broadcastcid = ($row->broadcastcid != 'NULL' && $row->broadcastcid != '') ? 'Enable' : 'Disable';
                return $row;
            });

        $filename = "ClientDetails.xlsx";
        
        return Excel::download(new ClientDetailsExport($data), $filename);
    }
    public function exportBrandStrings(Request $request)
    {
        $clid = $request->query('clid');
        $data = DB::table('clientkeyword')
            ->join('keyword_master', 'keyword_master.keyId', '=', 'clientkeyword.KeywordId')
            ->select(
                // 'keyword_master.KeyId as KeyId',
                'keyword_master.KeyWord as Keyword',
                'clientkeyword.Filter as Filter',
                'keyword_master.Filter_String as FilterString',
                'clientkeyword.Category as Category',
                'clientkeyword.Type as Type',
                'clientkeyword.CompanyS as CompanyS',
                'clientkeyword.BrandS as BrandS'
            )
            ->where('clientkeyword.clientid', $clid)
            ->orderBy('clientkeyword.Type', 'asc')
            ->get();

        $filename = "brandstrings.xlsx";

        return Excel::download(new BrandStringsExport($data), $filename);
    }
}




