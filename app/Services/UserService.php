<?php
namespace App\Services;

use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver; // Pake V3 sesuai request
use Illuminate\Support\Str;

class UserService
{
    public function createUser(array $data)
    {
        return DB::transaction(function () use ($data) {
            // 1. Create User Account
            $user = User::create([
                'name'    => $data['name'],
                'email'    => $data['email'],
                'password' => Hash::make($data['password']),
                'role'     => $data['role'], // admin / customer
            ]);

            event(new Registered($user));

            return $user;
        });
    }

    public function createProfile(array $data) {
        return DB::transaction(function () use ($data) {
            
        });
    }

    public function updateUser(User $user, array $data, $newAvatar = null)
    {
        return DB::transaction(function () use ($user, $data, $newAvatar) {
            
            // 1. Update Tabel User
            $userData = [
                'name'  => $data['name'],
                'email' => $data['email'],
                'role'  => $data['role'],
            ];

            // Cek kalau password diganti (tidak kosong)
            if (!empty($data['password'])) {
                $userData['password'] = Hash::make($data['password']);
            }

            $user->update($userData);

            // 2. Update/Create Profile
            // Kita pakai updateOrCreate jaga-jaga kalau user lama belum punya profile row
            $profileData = [
                'phone'  => $data['phone'] ?? null,
                'gender' => $data['gender'] ?? null,
            ];

            // 3. Handle Avatar Baru
            if ($newAvatar) {
                // Hapus avatar lama kalau ada
                if ($user->profile && $user->profile->avatar) {
                    Storage::disk('public')->delete($user->profile->avatar);
                }
                $profileData['avatar'] = $this->uploadAvatar($newAvatar);
            }

            $user->profile()->updateOrCreate(
                ['user_id' => $user->id], // Kondisi cari
                $profileData              // Data update
            );

            return $user;
        });
    }

    // Helper Upload Avatar (Mirip Product Image tapi lebih kecil)
    private function uploadAvatar($image)
    {
        $manager = new ImageManager(new Driver());
        $img = $manager->read($image->getRealPath());

        // Resize avatar jadi kotak 300x300
        $img->cover(300, 300); 
        $img->toWebp(80);

        $filename = 'avatars/' . Str::random(20) . '.webp';
        Storage::disk('public')->put($filename, (string) $img);

        return $filename;
    }
}