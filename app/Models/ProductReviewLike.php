<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductReviewLike extends Model
{
    protected $fillable = ['user_id', 'product_review_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function review()
    {
        return $this->belongsTo(ProductReview::class, 'product_review_id');
    }
}
