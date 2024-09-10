<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $hashedInputPassword = md5($request->password);
        $user = User::where('UserID', $request->userid)->first();
        if ($user) {
            if($hashedInputPassword == $user->Md5Pass && $user->status){
               // return Auth::login($user);
                if(Auth::loginUsingId ($user->Id)){
                   // return auth()->user();
                    return redirect()->route('dashboard');

                }
               
            }else{
                session()->flash('error','Invailed Password');
                return redirect()->back()->withInput();
            }
           
          
        } else {
            session()->flash('error','User not found');
            return redirect()->back()->withInput();
        }
    }
}
