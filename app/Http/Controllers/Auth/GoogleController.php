<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleController extends Controller
{
    public function redirectToGoogle() {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback() {
        try {
            // 1. Ambil Data dari Google
            $googleUser = Socialite::driver('google')->stateless()->user();

            // 2. Cari User di Database (Termasuk yang ada di Trash/Soft Deleted)
            $user = User::withTrashed()->where('email', $googleUser->getEmail())->first();

            // 🔥 CEK APAKAH USER INI KORBAN BANNED (SOFT DELETED)? 🔥
            if ($user && $user->trashed()) {
                // Kalau user ditemukan TAPI ada di tong sampah (deleted_at tidak null)
                // Berarti dia BANNED. Jangan kasih masuk!
                
                return redirect('/login')->with('error', 'Access Denied: Your account has been suspended/banned.');
            }

            // 3. LOGIKA REGISTER ATAU LINKING (Kalau User Aman / Tidak Banned)
            if (!$user) {
                // A. User Baru -> Register
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => null, 
                    'username' => Str::slug($googleUser->getName()) . rand(100, 999),
                    'role' => 'customer',
                    'email_verified_at' => now(),
                ]);

                $user->profile()->create([
                    'avatar' => $googleUser->getAvatar(),
                ]);

            } else {
                // B. User Lama (Yang statusnya Aktif/Tidak di Trash) -> Update Google ID
                if (empty($user->google_id)) {
                    $user->update([
                        'google_id' => $googleUser->getId(),
                        'email_verified_at' => now()
                    ]);
                }
            }

            // 4. LOGIN
            Auth::login($user);

            // 5. REDIRECT
            if ($user->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            }
            
            return redirect()->intended('/');

        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Login Google Error: ' . $e->getMessage());
        }   
    }
}