<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Loginwm_users extends Component
{
    public $loginsss;
    public $password;
    public $rememberpasswd;
    public $autherror;

    public function mount()
    {
        $this->fillPass();
    }

    public function render()
    {
        return view('livewire.loginss');
    }

    public function forgotPassword()
    {
        return redirect()->to('ForgotPassword');
    }

    private function fillPass()
    {
        $loginss = session('loginss');
        $password = session('pass');

        $this->loginsss = $loginss;
        $this->password = $password;

        if (trim($loginss) != "" && trim($password) != "") {
            $this->rememberpasswd = true;
        }
    }
    public function authenticate()
    {
        $user = User::where(['loginss'=>$this->loginss,'password'=>$this->password])->with('user_role')->first();
        if ($user) {
            if ($user->active) {
                Auth::loginss($user);
                $this->setRememberPassword($this->loginss, $this->password);
                return redirect()->to('dashboard');
            } else {
                $this->autherror = "User is Inactive!";
            }
        } else {
            $this->autherror = "User and password not found";
        }
    }

    private function setRememberPassword($loginss, $password)
    {
        session(['loginss' => $loginss]);
        session(['pass' => $password]);
    }
}