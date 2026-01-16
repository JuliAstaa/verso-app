<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function order() {
        return $this->belongsTo(Order::class);
    }

    // PENTING: Relasi ke Variant
    public function productVariant() {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }
}
