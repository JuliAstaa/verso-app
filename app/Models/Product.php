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

    public function reviews()
    {
        return $this->hasMany(ProductReview::class)->whereNull('parent_id');
    }

    public function getSoldCountAttribute()
    {
        $variantIds = $this->variants->pluck('id');

        return \App\Models\OrderItem::whereIn('product_variant_id', $variantIds)
            ->whereHas('order', function($query) {
                $query->whereIn('status', ['paid', 'shipped', 'completed']);
            })
            ->sum('quantity'); 
    }

    public function getRatingValueAttribute()
    {

        return $this->reviews()->count() > 0 
            ? number_format($this->reviews()->avg('rating'), 1) 
            : '0.0';
    }

    public function averageRating()
    {
        return round($this->reviews()->avg('rating'), 1);
    }

}
