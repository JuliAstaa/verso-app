<?php

namespace App\Livewire\Auth;

use App\Services\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Component;

class Register extends Component
{
    public $email, $password;

    public function register(UserService $service) {
        // pass
        $this->validate([
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);

        try {
            $generatedName = Str::of($this->email)->before('@')->replace('.', ' ')->title();

            $user = $service->createUser([
                'name'     => $generatedName, 
                'email'    => $this->email,
                'password' => $this->password,
                'role'     => 'admin',
            ]);

            Auth::login($user);

            redirect()->route('admin.dashboard');
        } catch (\Exception $e) {
            $this->addError('email', 'Registration failed: ' . $e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.auth.register');
    }
}
