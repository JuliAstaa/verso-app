<div class="flex flex-col lg:flex-row gap-10 items-start">
    <div class="w-full lg:w-56 sticky top-60 space-y-4 p-3 border border-brand-200 rounded-md bg-white z-10">
        <p class="text-sm font-bold text-gray-900 border-b border-gray-200 pb-3">REVIEW FILTER</p>
        <div class="space-y-3">
            @foreach([5,4,3,2,1] as $star)
            <label class="flex items-center gap-3 cursor-pointer group">
                <input type="checkbox" wire:click="toggleFilter({{ $star }})"
                       class="w-4 h-4 rounded border-gray-300 text-brand focus:ring-brand">
                <div class="flex items-center gap-1">
                    <span class="text-yellow-400">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="size-5" fill="currentColor">
                            <path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.8 33.8-2.3s14.8-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/>
                        </svg>
                    </span>
                    <span class="text-xs font-medium text-gray-600 group-hover:text-brand">{{ $star }}</span>
                </div>
            </label>
            @endforeach
        </div>
    </div>

    <div class="flex-1 w-full">
        <div class="flex flex-col mb-10 p-6 bg-gray-50 rounded-xl border border-brand-100">
            @if (session()->has('message'))
                <div class="mb-4 text-sm text-green-600 font-bold text-center italic">
                    {{ session('message') }}
                </div>
            @endif

            <p class="text-sm font-bold mb-3 italic text-brand-500 text-center">How is the quality of this product?</p>
            <div x-data="{ hoverRating: 0 }" class="flex justify-center gap-3 mb-4">
                @for($i = 1; $i <= 5; $i++) 
                    <span class="cursor-pointer"
                          @click="$wire.set('rating', {{ $i }})"
                          @mouseenter="hoverRating = {{ $i }}"
                          @mouseleave="hoverRating = 0"
                          :class="(hoverRating >= {{ $i }} || @js($rating) >= {{ $i }}) ? 'text-yellow-400' : 'text-gray-300'">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="size-6" fill="currentColor">
                            <path d="M316.9 18C311.6 7 300.4 0 288.1 0s-23.4 7-28.8 18L195 150.3 51.4 171.5c-12 1.8-22 10.2-25.7 21.7s-.7 24.2 7.9 32.7L137.8 329 113.2 474.7c-2 12 3 24.2 12.9 31.3s23 8 33.8 2.3l128.3-68.5 128.3 68.5c10.8 5.7 23.9 4.8 33.8-2.3s14.8-19.3 12.9-31.3L438.5 329 542.7 225.9c8.6-8.5 11.7-21.2 7.9-32.7s-13.7-19.9-25.7-21.7L381.2 150.3 316.9 18z"/>
                        </svg>
                    </span> 
                @endfor
            </div>
            <textarea wire:model="comment" placeholder="Write your review here..." class="w-full p-4 bg-white border border-gray-100 rounded-md text-sm outline-none h-28 mb-4"></textarea>
            <x-button wire:click="sendReview" variant="solid" class="w-full text-sm py-3">Send Reviews</x-button>
        </div>

        <div class="space-y-6">
            @forelse($reviews as $review)
                <div class="p-5 border shadow-xs rounded-xl bg-white" 
                    wire:key="review-{{ $review->id }}" 
                    x-data="{ openReplies: false }">
                    <div class="flex items-center gap-3 mb-3">
                        <img src="{{ $review->user->avatar }}" alt="{{ $review->user->avatar }}" class="w-10 h-10 rounded-full">
                        
                        <div>
                            <p class="text-sm font-bold text-gray-900">{{ $review->user->name }}</p>
                            <p class="text-[10px] text-gray-400">{{ $review->created_at->diffForHumans() }}</p>
                        </div>
                    </div>

                    <div class="flex mb-2 gap-1">
                        @for($i=0; $i < $review->rating; $i++) 
                            <span class="text-yellow-400">★</span>
                        @endfor
                    </div>

                    <p class="text-sm text-gray-700 mb-4">{{ $review->comment }}</p>
                    
                    <div class="flex items-center justify-between border-t border-gray-50 pt-3">
                        <div class="flex items-center gap-6">
                            <button wire:click="toggleLike({{ $review->id }})" class="flex items-center gap-1.5 text-[11px] font-medium text-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="{{ auth()->check() && $review->isLikedBy(auth()->id()) ? 'currentColor' : 'none' }}" stroke="currentColor" stroke-width="2" class="lucide-heart {{ auth()->check() && $review->isLikedBy(auth()->id()) ? 'text-red-500' : '' }}">
                                    <path d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z"/>
                                </svg>
                                <span>{{ $review->likes_count }} person helped</span>
                            </button>

                            @if($review->replies->count() > 0)
                                <button @click="openReplies = !openReplies" type="button" class="text-[11px] font-bold text-gray-500 uppercase hover:text-black transition-colors">
                                    <span x-text="openReplies ? 'HIDE REPLY' : 'SHOW REPLY ({{ $review->replies->count() }})'"></span>
                                </button>
                            @endif
                        </div>

                        <button wire:click="setReply({{ $review->id }})" class="flex items-center gap-1 text-[11px] font-bold text-gray-500 uppercase hover:text-brand-700">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="text-gray-400"><path d="M9 17l-5-5 5-5"/><path d="M20 18v-2a4 4 0 0 0-4-4H4"/></svg>
                            <span>{{ $replyTo == $review->id ? 'CANCEL' : 'REPLY' }}</span>
                        </button>
                    </div>

                    @if($replyTo == $review->id)
                        <div class="mt-4 ml-10 p-4 border-t border-gray-200">
                            <textarea wire:model="replyComment" placeholder="Write your reply..." class="w-full p-3 bg-white border border-gray-100 rounded-lg text-sm outline-none focus:border-brand-700 h-20 transition-all shadow-sm"></textarea>
                            <div class="flex justify-end mt-2">
                                <x-button variant="solid" wire:click="sendReply" class=" px-5 py-2 text-[10px] font-bold transition-all uppercase">Submit Reply</x-button>
                            </div>
                        </div>
                    @endif

                    <div x-show="openReplies" x-collapse class="mt-4 ml-10 pl-4">
                        @foreach($review->replies as $reply)
                            <div class="py-4 border-t border-gray-200">
                                <div class="flex items-center gap-2">
                                    <img src="{{ $reply->user->avatar }}" alt="{{ $reply->user->avatar }}" class="w-10 h-10 rounded-full">
                                    <span class="text-[11px] font-bold text-gray-900">{{ $reply->user->name }}</span>
                                    <span class="text-[9px] text-gray-400">. {{ $reply->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-xs mt-3 text-gray-600 leading-relaxed">{{ $reply->comment }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @empty
                <div class="flex flex-col items-center justify-center py-16 px-4">
                <div class="relative mb-6">
                    <img src="{{ asset('images/product/noReviews.svg') }}" 
                        alt="No reviews yet" 
                        class="relative w-48 h-48 md:w-58 md:h-58 object-contain opacity-90">
                </div>

                <div class="text-center space-y-2">
                    <h3 class="text-lg font-bold text-gray-800">No Reviews Yet</h3>
                    <p class="text-sm text-gray-500 max-w-[280px] mx-auto">
                        This product doesn't have any reviews. Be the first to share your experience!
                    </p>
                </div>
                
            </div>
            @endforelse

            <div class="mt-4">
                {{ $reviews->links('vendor.pagination.custome-verso') }}
            </div>
        </div>
    </div>
</div>