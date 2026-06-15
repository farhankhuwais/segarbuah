<x-app-layout title="Home">
    {{-- Hero Section --}}
    <section class="relative bg-gradient-to-br from-emerald-700 via-emerald-600 to-green-500 text-white overflow-hidden">
        <div class="absolute inset-0 bg-[url('https://images.unsplash.com/photo-1610348725531-843dff563e2c?w=1000&q=40&auto=format')] bg-cover bg-center opacity-15"></div>
        <div class="absolute inset-0 bg-gradient-to-r from-emerald-900/70 to-emerald-700/40"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20 md:py-28">
            <div class="max-w-2xl animate-fade-in-up">
                <span class="inline-flex items-center gap-1.5 bg-white/15 backdrop-blur-sm text-white text-sm font-medium px-4 py-1.5 rounded-full mb-6">
                    <i class="ph-bold ph-flower-tulip"></i>
                    100% Fresh Produce
                </span>
                <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-4">
                    Fresh Fruits & <br>
                    <span class="text-emerald-200">Vegetables</span>
                </h1>
                <p class="text-lg md:text-xl text-emerald-50/90 mb-8 max-w-xl leading-relaxed">
                    Straight from the farm to your table. Premium quality, farm-fresh produce delivered to your doorstep.
                </p>
                <div class="flex flex-wrap items-center gap-4">
                    <a href="{{ route('shop.index') }}" class="inline-flex items-center gap-2 bg-white text-emerald-700 font-semibold px-6 py-3 rounded-xl hover:bg-emerald-50 transition shadow-lg shadow-emerald-900/20">
                        Shop Now
                        <i class="ph-bold ph-arrow-right"></i>
                    </a>
                    <a href="#" class="inline-flex items-center gap-2 border-2 border-white/40 text-white font-semibold px-6 py-3 rounded-xl hover:bg-white/10 transition">
                        <i class="ph-bold ph-play-circle"></i>
                        Watch Video
                    </a>
                </div>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-16 bg-gradient-to-t from-white dark:from-gray-950 to-transparent"></div>
    </section>

    {{-- Promo Section --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-8 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="scroll-reveal bg-gradient-to-br from-emerald-500 to-emerald-700 rounded-xl p-5 text-white flex items-center gap-4 shadow-lg">
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center shrink-0">
                    <i class="ph-bold ph-truck text-2xl"></i>
                </div>
                <div>
                    <h4 class="font-semibold text-sm">Free Delivery</h4>
                    <p class="text-emerald-100 text-xs">Orders over Rp 100k</p>
                </div>
            </div>
            <div class="scroll-reveal stagger-1 bg-gradient-to-br from-amber-500 to-orange-600 rounded-xl p-5 text-white flex items-center gap-4 shadow-lg">
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center shrink-0">
                    <i class="ph-bold ph-percent text-2xl"></i>
                </div>
                <div>
                    <h4 class="font-semibold text-sm">Weekly Deals</h4>
                    <p class="text-amber-100 text-xs">Up to 40% off</p>
                </div>
            </div>
            <div class="scroll-reveal stagger-2 bg-gradient-to-br from-sky-500 to-blue-600 rounded-xl p-5 text-white flex items-center gap-4 shadow-lg">
                <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center shrink-0">
                    <i class="ph-bold ph-leaf text-2xl"></i>
                </div>
                <div>
                    <h4 class="font-semibold text-sm">100% Organic</h4>
                    <p class="text-sky-100 text-xs">Certified fresh</p>
                </div>
            </div>
        </div>
    </section>

    @if ($flashSales->count())
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="scroll-reveal bg-gradient-to-r from-red-600 via-red-500 to-orange-500 rounded-2xl p-6 sm:p-8 text-white shadow-xl overflow-hidden relative">
            <div class="absolute top-0 right-0 w-48 h-48 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
            <div class="absolute bottom-0 left-0 w-32 h-32 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/2"></div>
            <div class="relative z-10">
                <div class="flex flex-wrap items-center justify-between gap-4 mb-6">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                            <i class="ph-bold ph-lightning text-2xl" aria-hidden="true"></i>
                        </div>
                        <div>
                            <h2 class="text-xl font-bold">Flash Sale</h2>
                            <p class="text-red-100 text-sm">Limited time offers. Grab them fast!</p>
                        </div>
                    </div>
                    <div x-data="timer('{{ $flashSales->min('sale_ends_at') }}')" x-init="init()" class="flex items-center gap-2 text-sm">
                        <span class="text-white/80">Ends in:</span>
                        <span class="bg-white/20 backdrop-blur-sm rounded-lg px-3 py-1.5 font-mono font-bold text-lg" x-text="display"></span>
                    </div>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                    @foreach ($flashSales as $i => $product)
                        @php
                            $imgIds = ['photo-1610348725531-843dff563e2c', 'photo-1567306226416-28f0efdc88ce', 'photo-1507003211169-0a1dd7228f2d', 'photo-1553279768-865429fa0078'];
                            $imgId = $imgIds[$i % 4];
                            $discountPct = round((1 - $product->sale_price / $product->price) * 100);
                        @endphp
                        <a href="{{ route('shop.show', $product->slug) }}" class="bg-white/10 backdrop-blur-sm rounded-xl p-3 hover:bg-white/20 transition group">
                            <div class="aspect-square rounded-lg overflow-hidden bg-white/10 mb-2">
                                <img src="https://images.unsplash.com/{{ $imgId }}?w=200&q=50&fit=crop&auto=format" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" loading="lazy" onerror="this.remove()">
                            </div>
                            <p class="font-semibold text-sm truncate">{{ $product->name }}</p>
                            <div class="flex items-center gap-2 mt-1">
                                <span class="font-bold text-base">Rp {{ number_format($product->sale_price, 0, ',', '.') }}</span>
                                <span class="text-xs text-red-200 line-through">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            </div>
                            <span class="inline-block mt-1 bg-red-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full">-{{ $discountPct }}%</span>
                        </a>
                    @endforeach
                </div>
                <div class="mt-4 text-center">
                    <a href="{{ route('shop.index', ['sale' => 1]) }}" class="inline-flex items-center gap-1.5 text-sm font-medium text-white/90 hover:text-white transition">
                        View all deals
                        <i class="ph-bold ph-arrow-right text-xs" aria-hidden="true"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('timer', (endTime) => ({
                display: '',
                init() {
                    const update = () => {
                        const diff = new Date(endTime) - new Date();
                        if (diff <= 0) { this.display = '00:00:00'; return; }
                        const h = Math.floor(diff / 3600000), m = Math.floor((diff % 3600000) / 60000), s = Math.floor((diff % 60000) / 1000);
                        this.display = `${String(h).padStart(2,'0')}:${String(m).padStart(2,'0')}:${String(s).padStart(2,'0')}`;
                    };
                    update();
                    setInterval(update, 1000);
                }
            }));
        });
    </script>
    @endif

    {{-- Featured Products --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="flex items-end justify-between mb-10">
            <div class="scroll-reveal">
                <span class="text-emerald-600 dark:text-emerald-400 text-sm font-semibold tracking-wide uppercase flex items-center gap-2 mb-1">
                    <i class="ph-bold ph-star"></i>
                    Featured Products
                </span>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Fresh Picks For You</h2>
                <p class="text-gray-500 dark:text-gray-400 mt-1">Handpicked selections at their peak freshness</p>
            </div>
            <a href="{{ route('shop.index') }}" class="hidden sm:inline-flex items-center gap-1.5 text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 font-medium text-sm transition">
                View All
                <i class="ph-bold ph-arrow-right"></i>
            </a>
        </div>

        @if ($featuredProducts->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($featuredProducts as $i => $product)
                    @php
                        $unsplashIds = [
                            'photo-1610348725531-843dff563e2c',
                            'photo-1567306226416-28f0efdc88ce',
                            'photo-1507003211169-0a1dd7228f2d',
                            'photo-1553279768-865429fa0078',
                        ];
                        $imgId = $unsplashIds[$i % count($unsplashIds)];
                    @endphp
                     <div class="scroll-reveal stagger-{{ min($i, 3) + 1 }} group bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 overflow-hidden hover:shadow-lg hover:border-emerald-300 dark:hover:border-emerald-700 transition-all duration-300 flex flex-col"
                          x-data="{ quickShow: false, adding: false }">
                          <div class="h-52 bg-gradient-to-br from-emerald-100 via-green-50 to-emerald-50 dark:from-gray-800 dark:via-gray-800 dark:to-gray-900 relative overflow-hidden shrink-0">
                              <img src="https://images.unsplash.com/{{ $imgId }}?w=300&q=50&fit=crop&auto=format"
                                   alt="{{ $product->name }}"
                                   loading="lazy"
                                   onerror="this.remove()"
                                   class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                              <div class="absolute top-3 right-3 flex flex-col gap-1.5">
                                  @auth
                                      <form action="{{ route('wishlist.toggle', $product) }}" method="POST">
                                          @csrf
                                          <button type="submit" class="w-8 h-8 bg-white/90 dark:bg-gray-900/90 rounded-full flex items-center justify-center hover:bg-white dark:hover:bg-gray-900 transition shadow-sm" aria-label="Toggle wishlist">
                                              <i class="ph-bold ph-heart text-red-500 text-sm" aria-hidden="true"></i>
                                          </button>
                                      </form>
                                  @endauth
                              </div>
                              <div class="absolute top-3 left-3 flex flex-col gap-1.5">
                                  @if ($product->is_organic)
                                      <span class="bg-emerald-500 text-white text-[11px] font-bold px-2.5 py-1 rounded-full shadow-sm flex items-center gap-1">
                                          <i class="ph-fill ph-seal-check text-xs" aria-hidden="true"></i>
                                          ORGANIC
                                      </span>
                                  @endif
                                  @if ($product->is_seasonal)
                                      <span class="bg-amber-500 text-white text-[11px] font-bold px-2.5 py-1 rounded-full shadow-sm flex items-center gap-1">
                                          <i class="ph-fill ph-clock text-xs" aria-hidden="true"></i>
                                          SEASONAL
                                      </span>
                                  @endif
                                  @if ($product->activeSale()->exists())
                                      <span class="bg-red-500 text-white text-[11px] font-bold px-2.5 py-1 rounded-full shadow-sm">-{{ round((1 - $product->sale_price / $product->price) * 100) }}%</span>
                                  @elseif ($product->compare_price && $product->compare_price > $product->price)
                                      @php $discount = round((1 - $product->price / $product->compare_price) * 100); @endphp
                                      <span class="bg-red-500 text-white text-[11px] font-bold px-2.5 py-1 rounded-full shadow-sm">
                                          -{{ $discount }}%
                                      </span>
                                  @endif
                              </div>
                          </div>
                         <div class="p-4 flex flex-col flex-1">
                             <a href="{{ route('shop.show', $product->slug) }}">
                                 <p class="text-[11px] text-emerald-600 dark:text-emerald-400 font-semibold uppercase tracking-wider">{{ $product->category->name ?? 'Fresh Produce' }}</p>
                                 <h3 class="font-semibold text-gray-900 dark:text-white mt-1 leading-tight group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition">{{ $product->name }}</h3>
                                 <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 flex items-center gap-1">
                                     <i class="ph-bold ph-map-pin text-emerald-500" aria-hidden="true"></i>
                                     {{ $product->origin }}
                                 </p>
                                 <div class="flex items-center gap-1 text-amber-400 mt-1">
                                     @php $starAvg = round($product->reviews_avg_rating ?? 0); @endphp
                                     @for ($s = 1; $s <= 5; $s++)
                                         <i class="{{ $s <= $starAvg ? 'ph-fill ph-star' : 'ph-bold ph-star' }} text-[10px]" aria-hidden="true"></i>
                                     @endfor
                                 </div>
                             </a>
                             <div class="mt-auto pt-3 border-t border-gray-100 dark:border-gray-800">
                                 <div class="flex items-center justify-between mb-3">
                                     <div>
                                         @php
                                             $displayPrice = $product->activeSale()->exists() ? $product->sale_price : $product->price;
                                             $originalPrice = $product->activeSale()->exists() ? $product->price : null;
                                         @endphp
                                         <span class="text-lg font-bold text-emerald-600 dark:text-emerald-400">Rp {{ number_format($displayPrice, 0, ',', '.') }}</span>
                                         <span class="text-xs text-gray-400 dark:text-gray-500">/{{ $product->unit }}</span>
                                          @if ($originalPrice)
                                              <span class="block text-xs text-red-400 line-through">Rp {{ number_format($originalPrice, 0, ',', '.') }}</span>
                                          @elseif ($product->compare_price && $product->compare_price > $product->price)
                                              <span class="block text-xs text-gray-400 dark:text-gray-500 line-through">Rp {{ number_format($product->compare_price, 0, ',', '.') }}</span>
                                          @else
                                              <span class="invisible block text-xs">&nbsp;</span>
                                          @endif
                                     </div>
                                 </div>
                                 <div class="flex items-center gap-2">
                                     <button @click="adding = true; fetch('{{ route('cart.store') }}', { method: 'POST', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json', 'Accept': 'application/json' }, body: JSON.stringify({ product_id: {{ $product->id }}, quantity: {{ $product->min_order }} }) }).then(r => r.json()).then(d => { if(d.success) { adding = false; showToast('Added to cart!'); updateCartBadge(d.count); } })" :disabled="adding"
                                         class="flex-1 py-2 text-sm font-semibold bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl transition shadow-sm disabled:opacity-50 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500">
                                         <i class="ph-bold ph-shopping-cart text-xs" aria-hidden="true"></i>
                                         <span x-text="adding ? '...' : 'Cart'"></span>
                                     </button>
                                     <button @click.stop="$dispatch('open-quick-view', { id: {{ $product->id }}, name: '{{ $product->name }}', slug: '{{ $product->slug }}', price: {{ $product->price }}, unit: '{{ $product->unit }}', origin: '{{ $product->origin }}', organic: {{ $product->is_organic ? 'true' : 'false' }}, seasonal: {{ $product->is_seasonal ? 'true' : 'false' }}, category: '{{ $product->category->name ?? 'Fresh' }}', img: '{{ $imgId }}', discount: {{ $product->compare_price && $product->compare_price > $product->price ? round((1 - $product->price / $product->compare_price) * 100) : 0 }} })"
                                         class="py-2 px-3 text-sm font-medium text-emerald-600 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800 rounded-xl hover:bg-emerald-50 dark:hover:bg-emerald-900/20 transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500"
                                         aria-label="Quick view {{ $product->name }}">
                                         <i class="ph-bold ph-eye" aria-hidden="true"></i>
                                     </button>
                                 </div>
                             </div>
                         </div>
                     </div>
                @endforeach
            </div>
            <div class="mt-8 text-center sm:hidden">
                <a href="{{ route('shop.index') }}" class="inline-flex items-center gap-2 text-emerald-600 dark:text-emerald-400 font-medium text-sm">
                    View All Products
                    <i class="ph-bold ph-arrow-right"></i>
                </a>
            </div>
        @else
            <div class="text-center py-16 bg-gray-50 dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800">
                <i class="ph-bold ph-package text-5xl text-gray-300 dark:text-gray-600 mb-4"></i>
                <p class="text-gray-500 dark:text-gray-400">No featured products yet. Check back soon!</p>
            </div>
        @endif
    </section>

    {{-- Categories Section --}}
    <section class="bg-gray-50 dark:bg-gray-900/50 py-16 border-y border-gray-200 dark:border-gray-800">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10 scroll-reveal">
                <span class="text-emerald-600 dark:text-emerald-400 text-sm font-semibold tracking-wide uppercase flex items-center justify-center gap-2 mb-1">
                    <i class="ph-bold ph-grid-four"></i>
                    Categories
                </span>
                <h2 class="text-3xl font-bold text-gray-900 dark:text-white">Shop by Category</h2>
                <p class="text-gray-500 dark:text-gray-400 mt-1">Find exactly what you're looking for</p>
            </div>
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                @php
                    $catImages = [
                        'sayuran-daun' => 'photo-1610348725531-843dff563e2c',
                        'sayuran-umbi' => 'photo-1567306226416-28f0efdc88ce',
                        'sayuran-buah' => 'photo-1553279768-865429fa0078',
                        'buah-lokal' => 'photo-1507003211169-0a1dd7228f2d',
                        'buah-impor' => 'photo-1610348725531-843dff563e2c',
                        'herbal-rempah' => 'photo-1567306226416-28f0efdc88ce',
                        'organik' => 'photo-1553279768-865429fa0078',
                        'paket-hemat' => 'photo-1507003211169-0a1dd7228f2d',
                    ];
                @endphp
                @foreach ($categories as $i => $category)
                    @php $imgId = $catImages[$category->slug] ?? 'photo-1610348725531-843dff563e2c'; @endphp
                    <a href="{{ route('shop.index', ['category' => $category->slug]) }}"
                       class="scroll-reveal stagger-{{ min($i, 3) + 1 }} group relative bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 overflow-hidden hover:shadow-lg hover:border-emerald-300 dark:hover:border-emerald-700 transition-all duration-300">
                        <div class="h-32 sm:h-36 overflow-hidden">
                            <img src="https://images.unsplash.com/{{ $imgId }}?w=300&q=50&fit=crop&auto=format"
                                 alt="{{ $category->name }}"
                                 loading="lazy"
                                 onerror="this.remove()"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/10 to-transparent"></div>
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 p-4">
                            <h3 class="font-semibold text-white drop-shadow-lg">{{ $category->name }}</h3>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Why Choose Us --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <div class="scroll-reveal bg-gradient-to-br from-emerald-600 to-emerald-800 rounded-2xl p-8 md:p-12 text-white overflow-hidden relative">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/5 rounded-full -translate-y-1/2 translate-x-1/2"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-white/5 rounded-full translate-y-1/2 -translate-x-1/2"></div>
            <div class="relative">
                <div class="text-center mb-10">
                    <span class="text-emerald-200 text-sm font-semibold tracking-wide uppercase flex items-center justify-center gap-2 mb-1">
                        <i class="ph-bold ph-seal-check"></i>
                        Why Choose Us
                    </span>
                    <h2 class="text-3xl font-bold">The SegarBuah Promise</h2>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="text-center scroll-reveal stagger-1">
                        <div class="w-14 h-14 bg-emerald-500/30 backdrop-blur-sm rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i class="ph-bold ph-hand-heart text-2xl"></i>
                        </div>
                        <h3 class="font-semibold text-lg">Farm Fresh</h3>
                        <p class="text-emerald-100 text-sm mt-1">Picked at peak ripeness, delivered within 24 hours</p>
                    </div>
                    <div class="text-center scroll-reveal stagger-2">
                        <div class="w-14 h-14 bg-emerald-500/30 backdrop-blur-sm rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i class="ph-bold ph-shield-check text-2xl"></i>
                        </div>
                        <h3 class="font-semibold text-lg">Quality Guaranteed</h3>
                        <p class="text-emerald-100 text-sm mt-1">100% satisfaction or your money back</p>
                    </div>
                    <div class="text-center scroll-reveal stagger-3">
                        <div class="w-14 h-14 bg-emerald-500/30 backdrop-blur-sm rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i class="ph-bold ph-truck text-2xl"></i>
                        </div>
                        <h3 class="font-semibold text-lg">Free Shipping</h3>
                        <p class="text-emerald-100 text-sm mt-1">Free delivery for orders over Rp 100.000</p>
                    </div>
                    <div class="text-center scroll-reveal stagger-4">
                        <div class="w-14 h-14 bg-emerald-500/30 backdrop-blur-sm rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <i class="ph-bold ph-arrows-clockwise text-2xl"></i>
                        </div>
                        <h3 class="font-semibold text-lg">Easy Returns</h3>
                        <p class="text-emerald-100 text-sm mt-1">Not happy? We'll replace it, no questions asked</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
