<?php

namespace App\Http\Controllers;

use App\Models\Picklist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ManageUsers extends Controller
{
    public function index()
    {

        return view('manageusers', [
            'users' => User::select('Id', 'UserName', 'UserId', 'Password', 'ProfileId', 'RemoteProfileID', 'status', 'Profile')
                ->orderBy('UserId')->with('Remoteuser')->get(),
            'profiles' => Picklist::select('ID', 'Type', 'Name')->whereIn('Type', ['profile', 'Remote Profile'])->get()
                ->groupBy(function ($item) {
                    return strtolower($item->Type);
                })
        ]);
    }
    public function adduser(Request $request)
    {
        try {
            $request->validate([
                'userid' => 'required|string',
                'username' => 'required',
                'profile' => 'required',
                'password' => 'required',
                'remoteprofile' => 'required|numeric'
            ]);
    
            $profile = Picklist::find($request->profile);
            $user = new User();
            $user->UserID = $request->userid;
            $user->UserName = $request->username;
            $user->ProfileId = $request->profile;
            $user->Profile = $profile->Name;
            $user->RemoteProfileID = $request->remoteprofile;
            $user->Md5Pass = md5($request->password);
            $user->Password = $request->password;
            $user->AllowRemote = 0;
            $user->LastUpdate = now();
            $user->status = $request->status ?1: 0;
    
            if ($user->save()) {
                session()->flash('success', 'Record Added Successfully!');
                return response()->json(['success' => true, 'message' => 'Record Added Successfully!']);
            } else {
                return response()->json(['success' => false, 'message' => 'Operation Failed!']);
            }
        } catch (ValidationException $e) {
            session()->flash('error', 'Operation Failed!');
            return response()->json(['success' => false, 'errors' => $e->errors()]);
        }
    }
    public function edituser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'userid' => 'required|string',
            'username' => 'required',
            'profile' => 'required',
            'remoteprofile' => 'required|numeric'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }

        $profile = Picklist::find($request->profile);
        $user = User::where('UserID', $request->userid)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $user->UserName = $request->username;
        $user->ProfileId = $request->profile;
        $user->Profile = $profile->Name;
        $user->RemoteProfileID = $request->remoteprofile;
        $user->Md5Pass = md5($request->password);
        $user->AllowRemote = 0;
        $user->LastUpdate = now();
        $user->status = $request->has('status') ? 1 : 0;

        if ($user->save()) {
            session()->flash('success', 'Record Updated Successfully!');
            return response()->json(['success' => true]);
           
        }
        session()->flash('error', 'Operation Failed!');

        return response()->json(['error' => 'Operation Failed!'], 500);
    }
}
