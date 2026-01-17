<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BioManager extends Component
{
    use WithFileUploads;

    // Properti Form
    public $name, $email, $phone_number, $birth_date, $gender, $image;
    public $currentImage;
    
    // Properti UI
    public $openEditProfile = false;

    public function mount()
    {
        $user = Auth::user();
        $profile = $user->profile; // Relasi profile() di model User

        $this->name = $user->name;
        $this->email = $user->email;
        $this->phone_number = $profile->phone ?? '';
        $this->birth_date = $profile->birth_date ?? '';
        $this->gender = $profile->gender ?? '';
        $this->currentImage = $profile->avatar ?? null;
    }

    public function updateProfile()
    {
        $user = Auth::user();

        $this->validate([
            'name' => 'required|string|max:255',
            'phone_number' => 'nullable|string|max:15',
            'birth_date' => 'nullable|date',
            'gender' => 'nullable|string',
            'image' => 'nullable|image|max:10240',
        ]);

        // Update Tabel Users
        $user->update(['name' => $this->name]);

        // Siapkan Data Tabel UserProfiles
        $dataProfile = [
            'phone' => $this->phone_number,
            'birth_date' => $this->birth_date,
            'gender' => $this->gender,
        ];

        // Logika Upload Avatar
        if ($this->image) {
            if ($this->currentImage) {
                Storage::disk('public')->delete($this->currentImage);
            }
            $path = $this->image->store('avatars', 'public');
            $dataProfile['avatar'] = $path;
            $this->currentImage = $path;
        }

        $user->profile()->updateOrCreate(['user_id' => $user->id], $dataProfile);

        $this->image = null; // Reset input file
        $this->openEditProfile = false; // Tutup modal
    }

    public function render()
    {
        return view('livewire.profile.bio-manager');
    }
}