<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Category extends Model
{
    //
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];

    public function products(){
        return $this->hasMany(Product::class);
    }

    // Helper buat ambil URL gambar (biar aman kalau null)
    public function getImageUrlAttribute()
    {
        // Cek apakah kolom images ada isinya dan filenya beneran ada di storage
        if ($this->images && Storage::disk('public')->exists($this->images)) {
            return Storage::url($this->images);
        }
        
        // Return gambar default/placeholder kalau kosong
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&background=random';
    }
}
