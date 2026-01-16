<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class UserService
{
    public function createUser(array $data)
    {
        return DB::transaction(function () use ($data) {
            // 1. Create User Account
            $user = User::create([
                'name'     => $data['name'],
                'email'    => $data['email'],
                'password' => Hash::make($data['password']),
                'role'     => $data['role'],
            ]);

            // 2. 🔥 WAJIB: Bikin Profile Kosong buat User ini 🔥
            $this->createProfile($user);

            event(new Registered($user));

            return $user;
        });
    }

    /**
     * Bikin row baru di tabel user_profiles
     */
    public function createProfile(User $user) {
        // Kita create data kosong aja, atau default value
        return $user->profile()->create([
            'phone' => null,
            'birth_date' => null,
            'gender' => null,
            // Tambahin field lain kalau ada default value
        ]);
    }

    /**
     * Handle update profile user & avatar sekaligus.
     */
    public function updateUserProfile(User $user, array $data, ?UploadedFile $avatar = null)
    {
        return DB::transaction(function () use ($user, $data, $avatar) {
            
            // 1. Update Data Utama (Tabel Users)
            $user->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'username' => $data['username'] ?? $user->username,
            ]);

            // 2. Siapkan Data Profile
            $profileData = [
                'phone' => $data['phone'] ?? null,
                'birth_date' => $data['birth_date'] ?? null,
                'gender' => $data['gender'] ?? null,
            ];

            // 3. Handle Upload Foto (Jika ada file baru)
            if ($avatar) {
                // Hapus foto lama
                if ($user->profile && $user->profile->avatar) {
                    Storage::disk('public')->delete($user->profile->avatar);
                }

                // 🔥 UPDATE: Pake function uploadAvatar biar ke-resize & jadi WebP 🔥
                // Yang lama: $profileData['avatar'] = $avatar->store('avatars', 'public');
                $profileData['avatar'] = $this->uploadAvatar($avatar);
            }

            // 4. Simpan ke Tabel Profiles
            $user->profile()->updateOrCreate(
                ['user_id' => $user->id],
                $profileData
            );

            return $user;
        });
    }

    /**
     * Private helper buat resize & convert gambar
     */
    private function uploadAvatar($image)
    {
        // Pastikan driver sesuai (bisa Imagick atau Gd)
        // Kalau error driver, coba ganti Driver() jadi new \Intervention\Image\Drivers\Gd\Driver()
        $manager = new ImageManager(new Driver());
        
        $img = $manager->read($image->getRealPath());

        // Resize avatar jadi kotak 300x300 biar rapi
        $img->cover(300, 300); 
        
        // Convert ke WebP biar ringan
        $encoded = $img->toWebp(80);

        $filename = 'avatars/' . Str::random(20) . '.webp';
        
        // Simpan file hasil encode
        Storage::disk('public')->put($filename, (string) $encoded);

        return $filename;
    }
}