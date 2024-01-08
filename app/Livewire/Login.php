<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $userid;
    public $password;
    public $autherror;
    public function authenticate()
    {
        return $this->userid;
        $user = User::where(["login"=>$this->userid,"password"=>$this->password])->with('user_role')->first(['id', 'login', 'password', 'fullname', 'role', 'region', 'active']);
        if ($user) {
            if ($user->active) {
                Auth::login($user);
                // Redirect to 'admin_home' route or Livewire component
                return redirect()->to('admin_home');
            } else {
                $this->autherror = "User is Inactive!";
            }
        } else {
            $this->autherror = "Authentication Error!";
        }
    }
    public function render()
    {
        return view('livewire.login');
    }
}
