<?php

namespace App\Http\Controllers;

use App\Models\WmWebUniverse;
use Illuminate\Http\Request;

class WebUniverse extends Controller
{
    public function index()
    {   
        return view('webuniverse');
    }
    public function fetchWebUniverse(Request $request)
    {
        if ($request->ajax()) {
            $query = WmWebUniverse::where('deleted', '=', 0);
                if ($request->has('search') && $request->input('search.value') !== '') {
                $searchTerm = $request->input('search.value');
                $query->where(function ($query) use ($searchTerm) {
                    $query->where('name', 'LIKE', "%{$searchTerm}%")
                          ->orWhere('url', 'LIKE', "%{$searchTerm}%");
                });
            }
    
            $totalRecords = $query->count();
    
            $start = $request->input('start', 0);
            $length = $request->input('length', 10);
            $webuniverse = $query->orderBy('name')->offset($start)->limit($length)->get();    
            $data = [];
            foreach ($webuniverse as $item) {
                $data[] = [
                    'id' => $item->id,
                    'name' => $item->name,
                    'url' => $item->url,
                ];
            }
    
            return response()->json([
                'data' => $data,
                'draw' => $request->input('draw'),
                'recordsTotal' => $totalRecords, 
                'recordsFiltered' => $totalRecords,
            ]);
        }
        
    
        return abort(404);
    }
    
    
    
    
    public function view($id)
    {
        $webuniverse = WmWebUniverse::find(base64_decode($id));
        return view('viewwebuniverse',compact('webuniverse'));
    }
}
