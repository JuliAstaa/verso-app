<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email;
    public $password;

    public function login()
    {
        // 1. Validasi Sederhana
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Coba Login
        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            session()->regenerate();

            $defaultDesination = '/';

            // 3. Cek Role: Kalau Admin, tendang ke Dashboard/Product
            if (Auth::user()->role === 'admin') {
                $defaultDesination = route('admin.dashboard');
            }

            // Kalau Customer
            return redirect()->intended($defaultDesination);
        }

        // 4. Kalau Gagal
        $this->addError('email', 'Email atau password salah, Bang.');
    }
    public function render()
    {
        return view('livewire.auth.login');
    }
}
