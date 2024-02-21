<?php

namespace App\Http\Controllers;

use App\Models\Clinetprofile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ClientsProfile extends Controller
{
    public function index($id)
    {
        $data = Clinetprofile::with('contacts', 'contacts.delivery', 'contacts.regularDigestPrint', 'contacts.regularDigestWeb', 'Country', 'region', 'sector', 'keywords')->find($id);;
        $keywords = $data->keywords;
        $contacts = $data->contacts;
        $editing = '';
<<<<<<< Updated upstream
        return view('clients', compact('data', 'contacts', 'keywords', 'editing'));
=======
       return view('clients',compact('contacts','keywords','editing','data'));
>>>>>>> Stashed changes
    }
}
