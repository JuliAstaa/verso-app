<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    // redirect google 
    public function redirectToGoogle() {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback() {
        try {
            // ambild ata user
            $googleUser = Socialite::driver('google')->user();

            // cek google id
            $user = User::where('google_id', $googleUser->id)->first();

            if($user) {
                $user->update(['google_id' => $googleUser->id]);
            } else {
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => null,
                    'username' => null,
                    'role' => 'customer',
                    'email_verified_at' => now(),
                ]);

                $user->profile()->create([
                    'avatar' => $googleUser->getAvatar(),
                    'phone' => null,
                ]);

                // Login-kan User
                Auth::login($user);

                // Redirect sesuai Role
                if ($user->role === 'admin') {
                    return redirect()->intended('/admin/dashboard');
                }
                
                return redirect()->intended('/');

                }

        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Login Google gagal atau dibatalkan.');
        }   
    }
}
