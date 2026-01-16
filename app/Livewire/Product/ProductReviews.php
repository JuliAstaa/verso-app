<?php

namespace App\Livewire\Product;

use App\Models\ProductReview;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ProductReviewLike;

class ProductReviews extends Component
{
    use WithPagination;

    public $productId;
    public $filters = []; 
    public $rating = 0;   
    public $comment = ''; 

    public $replyTo = null; 
    public $replyComment = '';

    public function toggleFilter($star)
    {
        if (in_array($star, $this->filters)) {
            $this->filters = array_diff($this->filters, [$star]);
        } else {
            $this->filters[] = $star;
        }
        $this->resetPage();
    }

    public function sendReview()
    {
        $this->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|min:5',
        ]);

        ProductReview::create([
            'user_id' => auth()->id(),
            'product_id' => $this->productId,
            'rating' => $this->rating,
            'comment' => $this->comment,
        ]);

        $this->reset(['rating', 'comment']);
        session()->flash('message', 'Review sent successfully!');
    }

    public function setReply($reviewId)
    {
        if (!auth()->check()) return redirect()->route('login');
        
        // Jika diklik lagi pada review yang sama, tutup formnya (toggle)
        $this->replyTo = ($this->replyTo == $reviewId) ? null : $reviewId;
        $this->replyComment = ''; 
    }

    public function sendReply()
    {
        $this->validate([
            'replyComment' => 'required|string|min:2',
        ]);

        ProductReview::create([
            'user_id' => auth()->id(),
            'product_id' => $this->productId,
            'parent_id' => $this->replyTo,
            'rating' => null,
            'comment' => $this->replyComment,
        ]);

        $this->reset(['replyTo', 'replyComment']);
        session()->flash('message', 'Reply sent!');
    }

    public function toggleLike($reviewId)
    {
        if (!auth()->check()) {
            return redirect()->route('login'); 
        }

        $like = ProductReviewLike::where('user_id', auth()->id())
                                ->where('product_review_id', $reviewId)
                                ->first();

        if ($like) {
            $like->delete();
            ProductReview::find($reviewId)->decrement('likes_count');
        } else {
            ProductReviewLike::create([
                'user_id' => auth()->id(),
                'product_review_id' => $reviewId
            ]);
            ProductReview::find($reviewId)->increment('likes_count');
        }
    }

    public function render()
    {
        $query = ProductReview::where('product_id', $this->productId)
            ->whereNull('parent_id') 
            ->with(['user', 'variant', 'replies.user']) 
            ->latest();

        if (!empty($this->filters)) {
            $query->whereIn('rating', $this->filters);
        }

        return view('livewire.product.product-reviews', [
            'reviews' => $query->paginate(5)
        ]);
    }
}