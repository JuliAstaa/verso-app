<?php

namespace App\Livewire\Navbar;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Address extends Component
{
    public $openAddressModal = false;
    public $selectedAddress;

    public function mount()
    {
        // Ambil alamat default buat ditampilin di navbar
        if (Auth::check()) {
            $this->selectedAddress = Auth::user()->addresses()->where('is_default', true)->first() 
                ?? Auth::user()->addresses()->first();
        }
    }

    public function selectAddress($addressId)
    {
        $address = \App\Models\Address::find($addressId);
        if ($address) {
            $this->selectedAddress = $address;
            
            // Opsional: Simpan ke session kalau mau dipake di halaman Checkout
            session(['shipping_address_id' => $addressId]);
        }

        $this->openAddressModal = false;
        $this->dispatch('notify', message: 'Shipping address updated!');
    }

    public function render()
    {
        return view('livewire.navbar.address', [
            // Load semua alamat pas render biar modalnya up-to-date
            'addresses' => Auth::check() ? Auth::user()->addresses : collect([])
        ]);
    }
}