<?php

namespace App\Livewire\Front\UserProfile;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use App\Services\UserService; // 👈 1. Jangan lupa import ini

class BioData extends Component
{
    use WithFileUploads;

    public $name, $email, $phone, $birth_date, $gender, $username;
    public $avatar, $existingAvatar;
    public $openEditProfile = false;
    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->username = $user->username;
        $this->phone = $user->profile->phone ?? '';
        $this->birth_date = $user->profile->birth_date ?? '';
        $this->gender = $user->profile->gender ?? '';
        $this->existingAvatar = $user->profile->avatar ?? null;
    }

    // 👇 2. Inject UserService di parameter method ini
    public function updateProfile(UserService $userService)
    {
        $user = Auth::user();

        // A. Validasi (Tugas Livewire cuma sampai sini)
        $validated = $this->validate([
            'name' => 'required|string|min:3',
            // Rule: Harus string, Gak boleh spasi (alpha_dash), dan Unik (kecuali punya sendiri)
            'username' => 'required|string|alpha_dash|max:20|unique:users,username,' . $user->id,
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'phone' => 'nullable|numeric',
            'birth_date' => 'nullable|date',
            'gender' => 'nullable|in:Male,Female,Other',
            'avatar' => 'nullable|image|max:2048',
        ]);


        // B. Lempar tugas "nyimpen" ke Kuli (UserService) 🏗️
        $userService->updateUserProfile($user, $validated, $this->avatar);

        // C. Update Tampilan (Feedback UI)
        if ($this->avatar) {
            // Update preview foto biar langsung berubah tanpa refresh
            // Kita ambil path terbaru dari user yang baru diupdate
            $this->existingAvatar = $user->fresh()->profile->avatar; 
            $this->avatar = null; // Reset input file
        }

        $this->openEditProfile = false;

        $this->dispatch('swal:toast', [
            'icon' => 'success',
            'title' => 'Berhasil!',
            'text' => 'Profile berhasil diperbarui, Wok!',
        ]);
    }

    public function resendVerification()
{
    $user = Auth::user();

    // Cek dulu kali aja udah diverifikasi di tab lain
    if ($user->hasVerifiedEmail()) {
        session()->flash('success', 'Email sudah terverifikasi kok!');
        return;
    }

    // Perintah sakti Laravel buat kirim ulang email
    $user->sendEmailVerificationNotification();

    // Kasih notif sukses
    session()->flash('success', 'Link verifikasi baru sudah dikirim! Cek inbox/spam ya.');
}

    public function render()
    {
        $user = Auth::user();
        return view('livewire.front.user-profile.bio-data', ['user' => $user]);
    }
}