<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Models\UserProfile;
use Livewire\Attributes\On;

class Profile extends Component
{
use WithFileUploads;

    // User Data
    public $name, $email, $username;
    
    // Profile Data (Tambahan)
    public $phone, $gender, $birth_date, $avatar, $newAvatar;
    
    // Password
    public $current_password, $password, $password_confirmation;

    // modal
    public $showModalAddress = false;

    #[On('close-modal')] 
    #[On('address-created')] // Sekalian dengerin kalau sukses save, biar otomatis nutup
    public function closeModal()
    {
        $this->showModalAddress = false;
    }

    public function mount()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        // Data Utama
        $this->name = $user->name;
        $this->email = $user->email;
        $this->username = $user->username;

        // Data Profile (Pakai Null Coalescing Operator biar ga error kalau profile belum ada)
        $this->avatar = $user->profile?->avatar;
        $this->phone = $user->profile?->phone;
        $this->gender = $user->profile?->gender;
        $this->birth_date = $user->profile?->birth_date;
    }

    public function updateProfile()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $this->validate([
            'name'  => 'required|min:3',
            'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
            'username' => ['nullable', 'string', 'max:20', Rule::unique('users')->ignore($user->id)],
            'phone' => 'nullable|numeric',
            'gender' => 'nullable|in:male,female',
            'birth_date' => 'nullable|date',
            'newAvatar' => 'nullable|image|max:2048',
        ]);

        // 1. Update Tabel Users
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'username' => $this->username,
        ]);

        // 2. Handle Avatar Logic
        $avatarPath = $this->avatar; // Default path lama
        if ($this->newAvatar) {
            if ($this->avatar && Storage::disk('public')->exists($this->avatar)) {
                Storage::disk('public')->delete($this->avatar);
            }
            $avatarPath = $this->newAvatar->store('avatars', 'public');
            $this->newAvatar = null; // Reset input
        }

        // 3. Update Tabel User Profiles (Pakai updateOrCreate)
        $user->profile()->updateOrCreate(
            ['user_id' => $user->id], // Kondisi search
            [
                'phone' => $this->phone,
                'gender' => $this->gender,
                'birth_date' => $this->birth_date,
                'avatar' => $avatarPath
            ]
        );

        // Update tampilan avatar di browser
        $this->avatar = $avatarPath;

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'title' => 'Profile Updated',
            'text' => 'Informasi akun berhasil diperbarui.'
        ]);
    }

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

    public function confirmDeleteAddress($id)
    {
        $this->dispatch('swal:confirm', [
            'id' => $id,
            'title' => 'Hapus Alamat?',
            'text' => 'Yakin mau menghapus alamat ini? Data tidak bisa kembali.',
        ]);
    }

    #[On('deleteConfirmed')]
    public function deleteAddress($id)
    {

        \App\Models\Address::where('id', $id)
            ->where('user_id', Auth::id())
            ->delete();

        // Notif
        $this->dispatch('swal:toast', [
            'type' => 'success',
            'title' => 'Deleted',
            'text' => 'Alamat berhasil dihapus.'
        ]);
        
    }

    public function render()
    {
        $user = Auth::user();

        return view('livewire.admin.profile', [
            'user' => $user,
            'address' => $user->addresses()
                            ->with(['province', 'city', 'district', 'village'])
                            ->latest()
                            ->get()
        ]);
    }
}   