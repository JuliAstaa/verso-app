<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProductReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'product_variant_id',
        'parent_id',
        'rating',
        'comment',
        'likes_count'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function variant(): BelongsTo
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id');
    }

    public function replies(): HasMany
    {
        return $this->hasMany(ProductReview::class, 'parent_id')->orderBy('created_at', 'asc');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(ProductReview::class, 'parent_id');
    }

    public function likes(): HasMany
    {
        return $this->hasMany(ProductReviewLike::class);
    }

    public function isLikedBy($userId)
    {
        return $this->likes()->where('user_id', $userId)->exists();
    }
}
