<?php

namespace App\Http\Controllers;

use App\Models\Clinetprofile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ClientsProfile extends Controller
{
    public function index($id){

        
        $data = Cache::remember('Clinetprofile', now()->addMinutes(10), function () use ($id){
            return  Clinetprofile::with('contacts.delivery','contacts.regularDigestPrint','contacts.regularDigestWeb','Country','region','sector')->find($id);;
        });
        if (Cache::has('keywords')) {
            $keywords = Cache::get('keywords');
           
        }else{
            $keywords = $data->keywords()->paginate(10,pageName: 'keywords');
            Cache::put('keywords',  $keywords , now()->addMinutes(10));
        }
        if (Cache::has('contacts')) {

            $contacts = Cache::get('contacts');

        }else{
            $contacts = $data->contacts()->paginate(50,pageName: 'contacts'); 
            Cache::put('contacts',  $contacts , now()->addMinutes(10));
        }
       
      

       
        $editing = '';
        return view('clients',compact('contacts','keywords','editing','data'));
    }
   
}
