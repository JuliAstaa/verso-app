<section class="w-full bg-white py-12">
    <div class="mx-auto max-w-[90%] lg:max-w-[80%] bg-white border border-gray-100 rounded-xl p-6 shadow-sm">
        
        <div class="mb-8">
            <h2 class="text-2xl font-bold text-gray-900">Selected Category</h2>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
            
            @php
                // Data simulasi untuk preview
                $dummyCategories = [
                    ['name' => 'Jacket Man', 'image' => 'jacket.jpg'],
                    ['name' => 'T-Shirt', 'image' => 'tshirt.jpg'],
                    ['name' => 'Pants', 'image' => 'pants.jpg'],
                    ['name' => 'Shoes', 'image' => 'shoes.jpg'],
                    ['name' => 'Accessories', 'image' => 'acc.jpg'],
                ];
            @endphp

            @foreach($dummyCategories as $cat)
            <a href="#" class="group block border border-gray-200 rounded-lg p-4 hover:shadow-md hover:border-[#6B4F3B] transition-all duration-300">
                <div class="aspect-square w-full mb-4 overflow-hidden rounded-md bg-gray-50 flex items-center justify-center">
                    <img 
                        src="https://placehold.co/400x400/f9fafb/6B4F3B?text={{ $cat['name'] }}" 
                        alt="{{ $cat['name'] }}" 
                        class="w-full h-full object-contain group-hover:scale-110 transition-transform duration-300"
                    >
                </div>
                <h3 class="text-center font-semibold text-gray-800 group-hover:text-[#6B4F3B] truncate">
                    {{ $cat['name'] }}
                </h3>
            </a>
            @endforeach

        </div>
    </div>
</section>