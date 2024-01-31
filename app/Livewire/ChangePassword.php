<?php

namespace App\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChangePassword extends Component
{
    public $currentPassword;
    public $newPassword;
    public $confirmPassword;
    public $loading = false;
    public function render()
    {
        return view('livewire.change-password');
    }
    public function changePassword()
    {
        $this->loading = true;
        $this->validate([
            'currentPassword' => 'required',
            'newPassword' => 'required',
            'confirmPassword' => 'required|same:newPassword',
        ]);

        $user = Auth::user();
        $md5currentPassword = md5($this->currentPassword);
        $md5newPassword = md5($this->newPassword);

        if ( $md5currentPassword  == $user->Md5Pass) {
            $user->update([
                'Md5Pass' =>$md5newPassword,
            ]);
            $this->loading = false;
            session()->flash('message', 'Password changed successfully!');
        } else {
            $this->loading = false;
            session()->flash('error', 'Current password is incorrect.');
        }
    }

}
