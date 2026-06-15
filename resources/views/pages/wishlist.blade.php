<x-app-layout title="Wishlist">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-8 flex items-center gap-3">
            <i class="ph-bold ph-heart text-emerald-500" aria-hidden="true"></i>
            My Wishlist
        </h1>

        @if (session('success'))
            <div class="mb-6 p-4 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 rounded-xl text-sm text-emerald-700 dark:text-emerald-300 flex items-center gap-2">
                <i class="ph-bold ph-check-circle text-lg" aria-hidden="true"></i>
                {{ session('success') }}
            </div>
        @endif

        @if ($products->count())
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 sm:gap-6">
                @foreach ($products as $product)
                    <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 overflow-hidden hover:shadow-lg transition group scroll-reveal">
                        <a href="{{ route('shop.show', $product->slug) }}" class="block aspect-square bg-gradient-to-br from-emerald-100 via-green-50 to-emerald-50 dark:from-gray-800 dark:via-gray-800 dark:to-gray-900 relative">
                            @if ($product->image)
                                <img src="https://images.unsplash.com/{{ $product->image }}?w=300&q=50&fit=crop&auto=format" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" loading="lazy" onerror="this.remove()">
                            @endif
                            <form action="{{ route('wishlist.toggle', $product) }}" method="POST" class="absolute top-2 right-2">
                                @csrf
                                <button type="submit" class="w-8 h-8 bg-white/90 dark:bg-gray-900/90 rounded-full flex items-center justify-center hover:bg-white dark:hover:bg-gray-900 transition shadow-sm" aria-label="Remove from wishlist">
                                    <i class="ph-bold ph-heart text-red-500 text-sm" aria-hidden="true"></i>
                                </button>
                            </form>
                            @if ($product->compare_price && $product->compare_price > $product->price)
                                <span class="absolute top-2 left-2 bg-red-500 text-white text-xs font-bold px-2 py-0.5 rounded-full">
                                    -{{ round((1 - $product->price / $product->compare_price) * 100) }}%
                                </span>
                            @endif
                            @if ($product->is_organic)
                                <span class="absolute bottom-2 left-2 bg-emerald-500 text-white text-[10px] font-semibold px-2 py-0.5 rounded-full">Organic</span>
                            @endif
                        </a>
                        <div class="p-3 sm:p-4">
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-0.5">{{ $product->category->name }}</p>
                            <a href="{{ route('shop.show', $product->slug) }}" class="font-medium text-gray-900 dark:text-white text-sm block truncate group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition">{{ $product->name }}</a>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="font-bold text-emerald-600 dark:text-emerald-400 text-sm">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                @if ($product->compare_price && $product->compare_price > $product->price)
                                    <span class="text-xs text-gray-400 dark:text-gray-500 line-through">Rp {{ number_format($product->compare_price, 0, ',', '.') }}</span>
                                @endif
                            </div>
                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">/{{ $product->unit }}</p>
                            <a href="{{ route('shop.show', $product->slug) }}" class="mt-3 block w-full text-center bg-emerald-600 hover:bg-emerald-700 text-white font-medium py-2 rounded-xl text-xs transition">
                                <i class="ph-bold ph-shopping-cart text-xs" aria-hidden="true"></i>
                                Add to Cart
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $products->links() }}
            </div>
        @else
            <div class="text-center py-16">
                <i class="ph-bold ph-heart-straight text-6xl text-gray-300 dark:text-gray-600 mb-4" aria-hidden="true"></i>
                <p class="text-gray-500 dark:text-gray-400 mb-6">Your wishlist is empty.</p>
                <a href="{{ route('shop.index') }}" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-6 py-3 rounded-xl transition shadow-sm">
                    <i class="ph-bold ph-shopping-bag" aria-hidden="true"></i>
                    Browse Products
                </a>
            </div>
        @endif
    </div>
</x-app-layout>
