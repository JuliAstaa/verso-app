<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $guarded = ['id'];
    protected $fillable = ['category_id', 'name', 'slug', 'description', 'base_price', 'weight', 'is_active'];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function variants() {
        return $this->hasMany(ProductVariant::class);
    }

    public function images() {
        return $this->hasMany(ProductImage::class);
    }

    public function getPriceFormattedAttribute() {
        return 'Rp '. number_format($this->price, 0, ',', '.');
    }

}
