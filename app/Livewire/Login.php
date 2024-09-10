<?php

namespace App\Livewire;
use Livewire\Component;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class Login extends Component
{
    public $userid;
    public $password;
    public $rememberpasswd;
    public $autherror;

    public function mount()
    {
        $this->fillPass();  
    }

    public function render()
    {
        return view('livewire.login');
    }

    public function fillPass()
    {
        $userid = session('userid');
        $password = session('pass');

        $this->userid = $userid;
        $this->password = $password;

        if (trim($userid) != "" && trim($password) != "") {
            $this->rememberpasswd = true;
        }
    }

    public function authenticate()
    {
        $user = User::where(['UserID'=>$this->userid])->first();

        if ($user) {
            $hashedInputPassword = md5($this->password);

            if ($hashedInputPassword === $user->Md5Pass && $user->status) {

                Auth::login($user); 
                if($this->rememberpasswd){
                $this->setRememberPassword($this->userid, $this->password);
                }else{
                    session(['remember' => false]);
                }
                return redirect()->route('dashboard');
            } else {
                $this->autherror = "Invalid Password Or Account Disabled";
            }
        } else {
            $this->autherror = "User not found";
        }
    }

    private function setRememberPassword($userid, $password)
    {
        session(['userid' => $userid]);
        session(['pass' => $password]);
        session(['remember' => true]);
    }
}
