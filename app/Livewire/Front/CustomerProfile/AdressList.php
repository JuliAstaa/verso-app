<?php

namespace App\Livewire\Front\CustomerProfile;

use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Address; // 👈 Pake Model Address yang bener

class AdressList extends Component
{
public $showModalAddress = false;
    public $addressIdToEdit = null; // Penampung ID buat Edit

    // Listener biar pas modal ditutup/disimpan, list-nya refresh
    protected $listeners = [
        'close-modal' => 'closeModal',
        'address-created' => '$refresh' 
    ];

    public function closeModal()
    {
        $this->showModalAddress = false;
        $this->addressIdToEdit = null;
    }

    // 1. Logic CREATE (Reset ID jadi null)
    public function create()
    {
        $this->addressIdToEdit = null; 
        $this->showModalAddress = true;
    }

    // 2. Logic EDIT (Isi ID dari tombol)
    public function edit($id)
    {
        $this->addressIdToEdit = $id;
        $this->showModalAddress = true;
    }

    // 3. Logic DELETE
    public function deleteAddress($id)
    {
        $address = Address::where('id', $id)->where('user_id', Auth::id())->first();

        if ($address) {
            $address->delete();
            
            $this->dispatch('swal:toast', [
                'type' => 'success',
                'text' => 'Alamat berhasil dihapus.'
            ]);
        }
    }

    public function setDefault($addressId)
    {
        // A. Reset semua alamat user ini jadi non-default (false)
        Address::where('user_id', Auth::id())->update(['is_default' => false]);

        // B. Set alamat yang dipilih jadi default (true)
        Address::where('id', $addressId)->where('user_id', Auth::id())->update(['is_default' => true]);

        $this->dispatch('swal:toast', [
            'type' => 'success',
            'text' => 'Alamat utama berhasil diubah.'
        ]);
    }

    // Get Data
    public function getAddressesProperty()
    {
        return Address::where('user_id', Auth::id())
            ->with(['province', 'city', 'district']) // Eager load biar ringan query-nya
            ->orderBy('is_default', 'desc')
            ->latest()
            ->get();
    }
    public function render()
    {
        return view('livewire.front.customer-profile.adress-list', [
            'addresses' => $this->addresses
        ]);
    }
}
