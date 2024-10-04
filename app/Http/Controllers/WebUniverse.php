<?php

namespace App\Http\Controllers;

use App\Models\WmWebUniverse;
use Illuminate\Http\Request;

class WebUniverse extends Controller
{
    public function index()
    {   
        $webuniverse = WmWebUniverse::where('deleted', '=', 0)->paginate(10);
        return view('webuniverse',compact('webuniverse'));
    }

    public function view($id)
    {
        $webuniverse = WmWebUniverse::find(base64_decode($id));
        return view('viewwebuniverse',compact('webuniverse'));
    }
}
