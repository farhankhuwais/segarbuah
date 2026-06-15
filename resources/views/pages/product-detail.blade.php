<x-app-layout title="{{ $product->name }}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <nav class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400 mb-8 scroll-reveal">
            <a href="/" class="hover:text-emerald-600 dark:hover:text-emerald-400 transition">Home</a>
            <i class="ph-bold ph-caret-right text-xs"></i>
            <a href="{{ route('shop.index') }}" class="hover:text-emerald-600 dark:hover:text-emerald-400 transition">Shop</a>
            <i class="ph-bold ph-caret-right text-xs"></i>
            <span class="text-gray-900 dark:text-white font-medium truncate">{{ $product->name }}</span>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 mb-16">
            <div class="scroll-reveal">
                @php
                    $unsplashIds = [
                        'photo-1610348725531-843dff563e2c',
                        'photo-1567306226416-28f0efdc88ce',
                        'photo-1507003211169-0a1dd7228f2d',
                        'photo-1553279768-865429fa0078',
                    ];
                    $imgId = $unsplashIds[$product->id % count($unsplashIds)];
                @endphp
                <div class="relative bg-gradient-to-br from-emerald-100 via-green-50 to-emerald-50 dark:from-gray-800 dark:via-gray-800 dark:to-gray-900 rounded-2xl overflow-hidden">
                    <img src="https://images.unsplash.com/{{ $imgId }}?w=500&q=60&fit=crop&auto=format"
                         alt="{{ $product->name }}"
                         onerror="this.remove()"
                         class="w-full h-80 sm:h-96 object-cover">
                    <div class="absolute top-4 left-4 flex flex-col gap-2">
                        @if ($product->is_organic)
                            <span class="bg-emerald-500 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-sm flex items-center gap-1.5">
                                <i class="ph-fill ph-seal-check"></i>
                                ORGANIC
                            </span>
                        @endif
                        @if ($product->is_seasonal)
                            <span class="bg-amber-500 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-sm flex items-center gap-1.5">
                                <i class="ph-fill ph-clock"></i>
                                SEASONAL
                            </span>
                        @endif
                        @if ($product->activeSale()->exists())
                            <span class="bg-red-500 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-sm">
                                SALE -{{ round((1 - $product->sale_price / $product->price) * 100) }}%
                            </span>
                        @elseif ($product->compare_price && $product->compare_price > $product->price)
                            @php $discount = round((1 - $product->price / $product->compare_price) * 100); @endphp
                            <span class="bg-red-500 text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-sm">
                                -{{ $discount }}%
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <div class="scroll-reveal stagger-1 flex flex-col">
                <p class="text-sm font-semibold text-emerald-600 dark:text-emerald-400 uppercase tracking-wider mb-1">
                    {{ $product->category->name ?? 'Fresh Produce' }}
                </p>
                <h1 class="text-3xl lg:text-4xl font-bold text-gray-900 dark:text-white mb-2">{{ $product->name }}</h1>
                <div class="flex items-center gap-2 mb-4">
                    <div class="flex items-center text-amber-400">
                        @php $avg = round($product->reviews_avg_rating ?? 0); @endphp
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="ph-bold {{ $i <= $avg ? 'ph-star-fill' : 'ph-star' }} text-sm" aria-hidden="true"></i>
                        @endfor
                    </div>
                    <span class="text-xs text-gray-500 dark:text-gray-400">({{ $reviews->total() ?? 0 }})</span>
                </div>

                <div class="flex items-center gap-2 mb-4">
                    <i class="ph-bold ph-map-pin text-emerald-500"></i>
                    <span class="text-sm text-gray-600 dark:text-gray-400">{{ $product->origin }}</span>
                </div>

                <div class="flex items-baseline gap-3 mb-6">
                    @php $onSale = $product->activeSale()->exists(); @endphp
                    <span class="text-3xl font-bold {{ $onSale ? 'text-red-500' : 'text-emerald-600 dark:text-emerald-400' }}">Rp {{ number_format($onSale ? $product->sale_price : $product->price, 0, ',', '.') }}</span>
                    <span class="text-gray-400 dark:text-gray-500">/ {{ $product->unit }}</span>
                    @if ($onSale)
                        <span class="text-lg text-gray-400 dark:text-gray-500 line-through">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                        <span class="bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">-{{ round((1 - $product->sale_price / $product->price) * 100) }}%</span>
                    @elseif ($product->compare_price && $product->compare_price > $product->price)
                        <span class="text-lg text-gray-400 dark:text-gray-500 line-through">Rp {{ number_format($product->compare_price, 0, ',', '.') }}</span>
                    @endif
                </div>

                <div class="grid grid-cols-2 gap-3 mb-6">
                    <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-4">
                        <p class="text-xs text-gray-500 dark:text-gray-400">Weight</p>
                        <p class="font-semibold text-gray-900 dark:text-white mt-0.5">{{ $product->weight_in_grams }} gram</p>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-4">
                        <p class="text-xs text-gray-500 dark:text-gray-400">Min. Order</p>
                        <p class="font-semibold text-gray-900 dark:text-white mt-0.5">{{ $product->min_order }} {{ $product->unit }}</p>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-4">
                        <p class="text-xs text-gray-500 dark:text-gray-400">Stock</p>
                        <p class="font-semibold text-gray-900 dark:text-white mt-0.5">{{ $product->stock }} {{ $product->unit }}</p>
                    </div>
                    <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-4">
                        <p class="text-xs text-gray-500 dark:text-gray-400">SKU</p>
                        <p class="font-semibold text-gray-900 dark:text-white mt-0.5 text-sm truncate">{{ $product->sku }}</p>
                    </div>
                </div>

                @if ($product->storage_info)
                    <div class="flex items-start gap-2 mb-6 p-3 bg-blue-50 dark:bg-blue-900/20 rounded-xl text-sm text-blue-700 dark:text-blue-300">
                        <i class="ph-bold ph-snowflake mt-0.5"></i>
                        <span>{{ $product->storage_info }}</span>
                    </div>
                @endif

                @if ($product->description)
                    <div class="mb-6">
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-2 text-sm">Description</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400 leading-relaxed">{{ $product->description }}</p>
                    </div>
                @endif

                <div class="mt-auto pt-6 border-t border-gray-200 dark:border-gray-800" x-data="{ qty: {{ $product->min_order }}, adding: false, added: false }">
                    <div class="flex items-center gap-4">
                        <div class="flex items-center border border-gray-300 dark:border-gray-600 rounded-xl overflow-hidden">
                            <button @click="qty = Math.max({{ $product->min_order }}, qty - 1)" class="w-10 h-10 flex items-center justify-center text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition focus-visible:outline-none" aria-label="Decrease quantity">
                                <i class="ph-bold ph-minus" aria-hidden="true"></i>
                            </button>
                            <span class="w-12 h-10 flex items-center justify-center text-sm font-semibold text-gray-900 dark:text-white border-x border-gray-300 dark:border-gray-600" x-text="qty"></span>
                            <button @click="qty++" class="w-10 h-10 flex items-center justify-center text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition focus-visible:outline-none" aria-label="Increase quantity">
                                <i class="ph-bold ph-plus" aria-hidden="true"></i>
                            </button>
                        </div>
                        <button @click="adding = true; fetch('{{ route('cart.store') }}', { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json', 'Accept': 'application/json' }, body: JSON.stringify({ product_id: {{ $product->id }}, quantity: qty }) }).then(r => r.json()).then(d => { if(d.success) { added = true; adding = false; setTimeout(() => added = false, 2000); } })" :disabled="adding"
                                class="flex-1 font-semibold px-6 py-3 rounded-xl transition shadow-sm flex items-center justify-center gap-2 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500"
                                :class="added ? 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400' : 'bg-emerald-600 hover:bg-emerald-700 text-white'">
                            <template x-if="!added">
                                <span class="flex items-center gap-2">
                                    <i class="ph-bold ph-shopping-cart" :class="{ 'animate-spin': adding }" aria-hidden="true"></i>
                                    <span x-text="adding ? 'Adding...' : 'Add to Cart'"></span>
                                </span>
                            </template>
                            <template x-if="added">
                                <span class="flex items-center gap-2">
                                    <i class="ph-bold ph-check" aria-hidden="true"></i>
                                    Added!
                                </span>
                            </template>
                        </button>
                        <form action="{{ route('wishlist.toggle', $product) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-12 h-12 flex items-center justify-center border border-gray-300 dark:border-gray-600 rounded-xl text-gray-600 dark:text-gray-400 hover:bg-red-50 hover:text-red-500 dark:hover:bg-red-900/20 dark:hover:text-red-400 transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500" aria-label="Toggle wishlist">
                                <i class="ph-bold ph-heart text-lg" aria-hidden="true"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- Reviews --}}
        <section class="mt-12 scroll-reveal">
            <div class="flex items-center justify-between mb-6">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                    <i class="ph-bold ph-chat-circle text-emerald-500" aria-hidden="true"></i>
                    Reviews ({{ $reviews->total() }})
                </h2>
                <div class="flex items-center gap-1 text-amber-400">
                    @php $displayAvg = round($product->reviews_avg_rating ?? 0, 1); @endphp
                    @for ($i = 1; $i <= 5; $i++)
                        <i class="{{ $i <= round($displayAvg) ? 'ph-fill ph-star' : 'ph-bold ph-star' }} text-sm" aria-hidden="true"></i>
                    @endfor
                    <span class="text-sm text-gray-600 dark:text-gray-400 ml-1">{{ number_format($displayAvg, 1) }}</span>
                </div>
            </div>

            @auth
                @if ($hasPurchased)
                    <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-5 mb-6 transition-colors">
                        <h3 class="font-semibold text-gray-900 dark:text-white text-sm mb-3">
                            {{ $userReview ? 'Update your review' : 'Write a review' }}
                        </h3>
                        <form action="{{ route('reviews.store', $product) }}" method="POST">
                            @csrf
                            <div class="flex items-center gap-1 mb-3" x-data="{ rating: {{ $userReview->rating ?? 5 }} }">
                                <span class="text-sm text-gray-600 dark:text-gray-400 mr-2">Rating:</span>
                                <template x-for="i in 5" :key="i">
                                    <button type="button" @click="rating = i" class="text-xl focus-visible:outline-none" :class="i <= rating ? 'text-amber-400' : 'text-gray-300 dark:text-gray-600'" aria-label="Set rating">
                                        <i :class="i <= rating ? 'ph-fill ph-star' : 'ph-bold ph-star'" aria-hidden="true"></i>
                                    </button>
                                </template>
                                <input type="hidden" name="rating" x-model="rating">
                            </div>
                            <textarea name="comment" rows="3" placeholder="Share your experience with this product..." class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:border-emerald-500 focus:ring-emerald-500 px-4 py-2.5 placeholder-gray-400 dark:placeholder-gray-500 mb-3">{{ old('comment', $userReview->comment ?? '') }}</textarea>
                            <div class="flex items-center gap-3">
                                <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-5 py-2 rounded-xl text-sm transition shadow-sm">
                                    {{ $userReview ? 'Update' : 'Submit' }}
                                </button>
                                @if ($userReview)
                                    <form action="{{ route('reviews.destroy', [$product, $userReview]) }}" method="POST" class="inline" onsubmit="return confirm('Delete your review?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-sm text-red-500 hover:text-red-600 transition">Delete</button>
                                    </form>
                                @endif
                            </div>
                        </form>
                        @error('rating') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                @else
                    <div class="bg-gray-50 dark:bg-gray-800 rounded-2xl p-5 mb-6 text-center">
                        <p class="text-sm text-gray-500 dark:text-gray-400">Purchase this product to leave a review.</p>
                    </div>
                @endif
            @else
                <div class="bg-gray-50 dark:bg-gray-800 rounded-2xl p-5 mb-6 text-center">
                    <p class="text-sm text-gray-500 dark:text-gray-400">
                        <a href="{{ route('login') }}" class="text-emerald-600 dark:text-emerald-400 hover:underline">Log in</a> to leave a review.
                    </p>
                </div>
            @endauth

            <div class="space-y-4">
                @forelse ($reviews as $review)
                    <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-5 transition-colors">
                        <div class="flex items-center justify-between mb-2">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 rounded-full bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center text-emerald-600 dark:text-emerald-400 text-sm font-bold">
                                    {{ substr($review->user->name, 0, 1) }}
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-900 dark:text-white">{{ $review->user->name }}</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">{{ $review->created_at->format('d M Y') }}</p>
                                </div>
                            </div>
                            <div class="flex items-center text-amber-400">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i class="{{ $i <= $review->rating ? 'ph-fill ph-star' : 'ph-bold ph-star' }} text-xs" aria-hidden="true"></i>
                                @endfor
                            </div>
                        </div>
                        @if ($review->comment)
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $review->comment }}</p>
                        @endif
                    </div>
                @empty
                    <p class="text-center text-gray-500 dark:text-gray-400 py-8">No reviews yet. Be the first!</p>
                @endforelse
            </div>

            <div class="mt-6">
                {{ $reviews->links() }}
            </div>
        </section>

        @if ($related->count())
            <section>
                <div class="flex items-end justify-between mb-8 scroll-reveal">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Related Products</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">More from {{ $product->category->name ?? 'this category' }}</p>
                    </div>
                    <a href="{{ route('shop.index', ['category' => $product->category?->slug]) }}" class="text-sm font-medium text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 flex items-center gap-1">
                        View All
                        <i class="ph-bold ph-arrow-right"></i>
                    </a>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                    @foreach ($related as $i => $item)
                        @php
                            $relImgId = $unsplashIds[$item->id % count($unsplashIds)];
                        @endphp
                        <a href="{{ route('shop.show', $item->slug) }}"
                           class="scroll-reveal stagger-{{ min($i, 3) + 1 }} group bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 overflow-hidden hover:shadow-lg hover:border-emerald-300 dark:hover:border-emerald-700 transition-all duration-300">
                            <div class="h-44 bg-gradient-to-br from-emerald-100 via-green-50 to-emerald-50 dark:from-gray-800 dark:via-gray-800 dark:to-gray-900 relative overflow-hidden">
                                <img src="https://images.unsplash.com/{{ $relImgId }}?w=300&q=50&fit=crop&auto=format"
                                     alt="{{ $item->name }}"
                                     loading="lazy"
                                     onerror="this.remove()"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                @if ($item->is_organic)
                                    <span class="absolute top-3 left-3 bg-emerald-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full">ORGANIC</span>
                                @endif
                                @if ($item->compare_price && $item->compare_price > $item->price)
                                    @php $disc = round((1 - $item->price / $item->compare_price) * 100); @endphp
                                    <span class="absolute top-3 right-3 bg-red-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full">-{{ $disc }}%</span>
                                @endif
                            </div>
                            <div class="p-4">
                                <p class="text-[10px] text-emerald-600 dark:text-emerald-400 font-semibold uppercase tracking-wider">{{ $item->category->name ?? 'Fresh' }}</p>
                                <h3 class="font-semibold text-gray-900 dark:text-white mt-0.5 text-sm">{{ $item->name }}</h3>
                                <div class="flex items-center justify-between mt-3">
                                    <span class="font-bold text-emerald-600 dark:text-emerald-400">Rp {{ number_format($item->price, 0, ',', '.') }}<span class="text-xs text-gray-400 dark:text-gray-500">/{{ $item->unit }}</span></span>
                                    <button class="w-8 h-8 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg flex items-center justify-center transition">
                                        <i class="ph-bold ph-plus text-sm"></i>
                                    </button>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
</x-app-layout>