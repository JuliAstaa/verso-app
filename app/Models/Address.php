<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Laravolt\Indonesia\Models\Province;
use Laravolt\Indonesia\Models\City;
use Laravolt\Indonesia\Models\District;
use Laravolt\Indonesia\Models\Village;

class Address extends Model
{
    protected $guarded = ['id'];

    public function user() {
        $this->belongsTo(User::class);
    }

    // Relasi ke Provinsi
    public function province()
    {
        return $this->belongsTo(Province::class, 'province_code', 'code');
    }

    // Relasi ke Kota
    public function city()
    {
        return $this->belongsTo(City::class, 'city_code', 'code');
    }

    // Relasi ke Kecamatan
    public function district()
    {
        return $this->belongsTo(District::class, 'district_code', 'code');
    }

    // Relasi ke Desa
    public function village()
    {
        return $this->belongsTo(Village::class, 'village_code', 'code');
    }
}
