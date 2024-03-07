<?php

namespace App\Http\Controllers;

use App\Models\Picklist;
use App\Models\User;
use Illuminate\Http\Request;

class ManageUsers extends Controller
{
    public function index()
    {

        return view('manageusers', [
            'users' => User::select('Id', 'UserName', 'UserId', 'Password', 'ProfileId', 'RemoteProfileID','status')
                ->get(),
            'profiles' => Picklist::select('ID', 'Type', 'Name')->whereIn('Type', ['profile', 'Remote Profile'])->get()
                ->groupBy(function ($item) {
                    return strtolower($item->Type);
                })
        ]);
    }
    public function adduser(Request $request)
    {
     
        $request->validate(
            [
                'userid' => 'required|string',
                'username' => 'required',
                'password' => 'required',
                'confirmpassword' => 'required|same:password',
                'profile' => 'required',
                'remoteprofile' => 'required|numeric'
            ]
        );
        $profile = Picklist::find($request->profile);
        $user = new User();
        $user->UserID = $request->userid;
        $user->UserName = $request->username;
        $user->Password = $request->password;
        $user->ProfileId = $request->profile;
        $user->Profile = $profile->Name;
        $user->RemoteProfileID = $request->remoteprofile;
        $user->Md5Pass = md5($request->password);
        $user->AllowRemote = 0;
        $user->LastUpdate = now();
        if(isset($request->status)){
            $user->status = $request->status;
        }else{
            $user->status = 0;
        }
      
        if ($user->save()) {
            return redirect()->back()->with('success', 'Record Added Successfully!');
        }

        return redirect()->back()->withErrors(['error' => 'Operation Failed!']);
    }
    public function edituser(Request $request)
    {
        
        $request->validate([
            'userid' => 'required|string',
            'username' => 'required',
            'password' => 'required',
            'confirmpassword' => 'required|same:password',
            'profile' => 'required',
            'remoteprofile' => 'required|numeric'
        ]);
       
        $profile = Picklist::find($request->profile);
        $id = json_decode($request->id,true)['Id'];
        $user = User::findOrFail($id);
        $user->UserID = $request->userid;
        $user->UserName = $request->username;
        $user->Password = $request->password;
        $user->ProfileId = $request->profile;
        $user->Profile = $profile->Name;
        $user->RemoteProfileID = $request->remoteprofile;
        $user->Md5Pass = md5($request->password);
        $user->AllowRemote = 0;
        $user->LastUpdate = now();
        if(isset($request->status)){
            $user->status = $request->status;
        }else{
            $user->status = 0;
        }
        if ($user->save()) {
            return redirect()->back()->with('success', 'Record Updated Successfully!');
        }

        return redirect()->back()->withErrors(['error' => 'Operation Failed!']);
    }
}
