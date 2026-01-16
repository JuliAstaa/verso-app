<?php

namespace App\Livewire\Front\Address;

use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\Village;
use Livewire\Component;

class Form extends Component
{
    // Tambahkan properti addressId untuk melacak kita lagi Edit atau Create
    public $addressId = null; 
    
    public $label, $receiver_name, $phone, $detail, $postal_code, $is_default = false;

    // Dropdown Data
    public $provinces = [], $cities = [], $districts = [], $villages = [];
    public $province_code, $city_code, $district_code, $village_code;

    // Terima parameter $id (opsional). Kalau ada $id berarti Edit, kalau null berarti Create.
    public function mount($id = null)
    {
        $this->provinces = Province::pluck('name', 'code');
        
        // Simpan ID ke properti
        $this->addressId = $id;

        if ($id) {
            // --- LOGIC EDIT ---
            // Cari alamat spesifik berdasarkan ID, bukan cuma berdasarkan User ID
            $address = Address::where('user_id', Auth::id())->where('id', $id)->firstOrFail();

            $this->label = $address->label;
            $this->receiver_name = $address->receiver_name;
            $this->phone = $address->phone;
            $this->postal_code = $address->postal_code;
            $this->detail = $address->detail;
            $this->is_default = (bool) $address->is_default;

            $this->province_code = $address->province_code;
            $this->cities = City::where('province_code', $this->province_code)->pluck('name', 'code');

            $this->city_code = $address->city_code;
            $this->districts = District::where('city_code', $this->city_code)->pluck('name', 'code');

            $this->district_code = $address->district_code;
            $this->villages = Village::where('district_code', $this->district_code)->pluck('name', 'code');

            $this->village_code = $address->village_code;
        } 
        // Kalau $id null, form akan kosong (Logic Create)
    }

    // ... (Method updatedProvinceCode, dll biarkan sama) ...
    public function updatedProvinceCode($value)
    {
        $this->cities = City::where('province_code', $value)->pluck('name', 'code');
        $this->reset(['city_code', 'district_code', 'village_code', 'districts', 'villages']);
    }
    
    public function updatedCityCode($value)
    {
        $this->districts = District::where('city_code', $value)->pluck('name', 'code');
        $this->reset(['district_code', 'village_code', 'villages']);
    }

    public function updatedDistrictCode($value)
    {
        $this->villages = Village::where('district_code', $value)->pluck('name', 'code');
        $this->reset(['village_code']);
    }

    public function save()
    {
        $this->validate([
            'label' => 'required',
            'receiver_name' => 'required',
            'phone' => 'required|numeric',
            'province_code' => 'required',
            'city_code' => 'required',
            'district_code' => 'required',
            'village_code' => 'required',
            'detail' => 'required',
        ]);

        // Kalau alamat ini diset default, alamat lain milik user ini harus di-uncheck default-nya
        if ($this->is_default) {
            Address::where('user_id', Auth::id())->update(['is_default' => false]);
        }

        // Logic Penyimpanan yang Benar
        Address::updateOrCreate(
            ['id' => $this->addressId], // KUNCI: Cari berdasarkan ID Alamat (bukan cuma user_id)
            [
                'user_id' => Auth::id(), // Pastikan user_id tetap masuk
                'label' => $this->label,
                'receiver_name' => $this->receiver_name,
                'phone' => $this->phone,
                'province_code' => $this->province_code,
                'city_code' => $this->city_code,
                'district_code' => $this->district_code,
                'village_code' => $this->village_code,
                'postal_code' => $this->postal_code,
                'detail' => $this->detail,
                'is_default' => $this->is_default 
            ]
        );

        $this->dispatch('address-created'); 
        $this->dispatch('close-modal');    
        
        $this->dispatch('swal:toast', [
            'type' => 'success',
            'text' => $this->addressId ? 'Alamat berhasil diperbarui.' : 'Alamat baru berhasil ditambahkan.'
        ]);

        // Reset form setelah save biar bersih kalau mau add lagi
        $this->reset(); 
    }

    public function render()
    {
        return view('livewire.front.address.form');
    }
}