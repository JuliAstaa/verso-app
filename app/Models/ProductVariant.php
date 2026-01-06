<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    
    use HasFactory;

    protected $fillable = ['size_id', 'color_id', 'sku', 'stock', 'price'];

    //
    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function size() {
        return $this->belongsTo(Size::class);
    }

    public function colors() {
        return $this->belongsTo(Color::class);
    }
}
