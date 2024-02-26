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
}
