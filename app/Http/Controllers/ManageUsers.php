<?php

namespace App\Http\Controllers;

use App\Models\Picklist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ManageUsers extends Controller
{
    public function index()
    {
        
        $profiles['remote profile'] = Picklist::select('ID', 'Type', 'Name')->whereIn('id',[523, 524, 525, 526, 527, 528, 547, 685, 1087, 1195, 1201, 1300])->get();
        $profiles['profile'] = User::select('profile')->distinct('profile')->orderBy('profile')->get();
        return view('manageusers', [
            'users' => User::select('Id', 'UserName', 'UserId', 'Password', 'ProfileId', 'RemoteProfileID', 'status', 'Profile')
                ->orderBy('UserId')->with('Remoteuser')->get(),
            'profiles'=>$profiles
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
            ]);
    
            $user = new User();
            $user->UserID = $request->userid;
            $user->UserName = $request->username;
            $user->Profile = $request->profile;
            $user->RemoteProfileID = $request->remoteprofile??0;
            $user->Md5Pass = md5($request->password);
            $user->Password = $request->password;
            $user->AllowRemote = 0;
            $user->LastUpdate = now();
            $user->status = 1;
    
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
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()]);
        }
        $user = User::where('UserID', $request->userid)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $user->UserName = $request->username;
        $user->Profile = $request->profile;
        $user->RemoteProfileID = $request->remoteprofile??0;
        $user->Md5Pass = md5($request->password);
        $user->AllowRemote = 0;
        $user->LastUpdate = now();

        if ($user->save()) {
            session()->flash('success', 'Record Updated Successfully!');
            return response()->json(['success' => true]);
           
        }
        session()->flash('error', 'Operation Failed!');

        return response()->json(['error' => 'Operation Failed!'], 500);
    }
    public function enabledisable($id) {
        $user = User::findOrFail($id);
        $user->status = !$user->status;
        $user->update();
        session()->flash('success', 'Record Updated Successfully!');
        return response()->json(['success' => true]);
    }
}
