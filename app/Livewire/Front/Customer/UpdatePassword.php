<?php

namespace App\Livewire\Front\Customer;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UpdatePassword extends Component
{   
    public $current_password, $password, $password_confirmation;

    public function updatePassword()
    {
        $this->validate([
            'current_password' => 'required|current_password',
            'password' => 'required|min:6|confirmed',
        ]);
        
        
        Auth::user()->update([
            'password' => Hash::make($this->password)
        ]);

        
        $this->dispatch('swal:toast', [
            'type' => 'success',
            'title' => 'Password Changed',
            'text' => 'Password berhasil diubah.'
        ]);
        $this->reset(['current_password', 'password', 'password_confirmation']);
    }
    public function render()
    {
        return view('livewire.front.customer.update-password');
    }
}
