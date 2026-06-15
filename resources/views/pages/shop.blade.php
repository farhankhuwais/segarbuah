<x-app-layout title="Shop">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-8">
            <div class="scroll-reveal">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Shop</h1>
                <p class="text-gray-500 dark:text-gray-400 mt-1 flex items-center gap-1.5">
                    <i class="ph-bold ph-package text-emerald-500" aria-hidden="true"></i>
                    {{ $products->total() }} products found
                </p>
            </div>

            <div class="flex items-center gap-3">
                <form method="GET" action="{{ route('shop.index') }}" class="flex items-center gap-2 flex-1 sm:flex-none">
                    @if(request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    @if(request('organic'))
                        <input type="hidden" name="organic" value="{{ request('organic') }}">
                    @endif
                    @if(request('seasonal'))
                        <input type="hidden" name="seasonal" value="{{ request('seasonal') }}">
                    @endif

                    <div class="relative flex-1 sm:flex-none">
                        <input type="text" name="search" placeholder="Search products..." value="{{ request('search') }}"
                               class="w-full sm:w-56 pl-9 pr-3 py-2.5 border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition placeholder-gray-400 dark:placeholder-gray-500"
                               aria-label="Search products">
                        <i class="ph-bold ph-magnifying-glass absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none" aria-hidden="true"></i>
                    </div>

                    <div class="relative">
                        <select name="sort" onchange="this.form.submit()"
                                class="appearance-none pl-8 pr-8 py-2.5 border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition"
                                aria-label="Sort products">
                            <option value="latest" {{ request('sort') === 'latest' ? 'selected' : '' }}>Latest</option>
                            <option value="oldest" {{ request('sort') === 'oldest' ? 'selected' : '' }}>Oldest</option>
                            <option value="cheapest" {{ request('sort') === 'cheapest' ? 'selected' : '' }}>Cheapest</option>
                            <option value="most_expensive" {{ request('sort') === 'most_expensive' ? 'selected' : '' }}>Most Expensive</option>
                            <option value="name_asc" {{ request('sort') === 'name_asc' ? 'selected' : '' }}>A-Z</option>
                            <option value="name_desc" {{ request('sort') === 'name_desc' ? 'selected' : '' }}>Z-A</option>
                        </select>
                        <i class="ph-bold ph-arrows-down-up absolute left-2.5 top-1/2 -translate-y-1/2 text-gray-400 text-sm pointer-events-none" aria-hidden="true"></i>
                    </div>

                    <button type="button" x-data @click="$dispatch('open-mobile-filters')" class="lg:hidden w-10 h-10 flex items-center justify-center border border-gray-300 dark:border-gray-700 rounded-xl text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800 transition" aria-label="Open filters">
                        <i class="ph-bold ph-funnel text-lg" aria-hidden="true"></i>
                    </button>
                </form>
            </div>
        </div>

        <div class="flex gap-8">
            <aside class="w-60 shrink-0 hidden lg:block" aria-label="Filters">
                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-5 sticky top-20 transition-colors">
                    <h3 class="font-semibold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                        <i class="ph-bold ph-funnel text-emerald-500" aria-hidden="true"></i>
                        Filters
                    </h3>

                    <div class="mb-6">
                        <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Categories</h4>
                        <ul class="space-y-1.5" role="list">
                            <li>
                                <a href="{{ route('shop.index', array_merge(request()->except('category'), ['category' => ''])) }}"
                                   class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500 {{ !request('category') ? 'bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 font-medium' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800' }}">
                                    <i class="ph-bold ph-grid-four text-xs" aria-hidden="true"></i>
                                    All Categories
                                </a>
                            </li>
                            @foreach ($categories as $cat)
                                <li>
                                    <a href="{{ route('shop.index', array_merge(request()->except('category'), ['category' => $cat->slug])) }}"
                                       class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500 {{ request('category') === $cat->slug ? 'bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 font-medium' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800' }}">
                                        <i class="ph-bold ph-caret-right text-xs" aria-hidden="true"></i>
                                        {{ $cat->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Product Labels</h4>
                    <ul class="space-y-2" role="list">
                        <li>
                            <a href="{{ route('shop.index', array_merge(request()->except('organic'), ['organic' => request('organic') ? '' : '1'])) }}"
                               class="flex items-center gap-2 text-sm transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500 {{ request('organic') ? 'text-emerald-600 dark:text-emerald-400 font-medium' : 'text-gray-600 dark:text-gray-400 hover:text-emerald-600 dark:hover:text-emerald-400' }}">
                                <span class="w-5 h-5 rounded flex items-center justify-center border-2 {{ request('organic') ? 'bg-emerald-500 border-emerald-500' : 'border-gray-300 dark:border-gray-600' }} transition" aria-hidden="true">
                                    @if(request('organic'))
                                        <i class="ph-bold ph-check text-white text-xs"></i>
                                    @endif
                                </span>
                                <i class="ph-fill ph-seal-check text-emerald-500 text-sm" aria-hidden="true"></i>
                                Organic Only
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('shop.index', array_merge(request()->except('seasonal'), ['seasonal' => request('seasonal') ? '' : '1'])) }}"
                               class="flex items-center gap-2 text-sm transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500 {{ request('seasonal') ? 'text-emerald-600 dark:text-emerald-400 font-medium' : 'text-gray-600 dark:text-gray-400 hover:text-emerald-600 dark:hover:text-emerald-400' }}">
                                <span class="w-5 h-5 rounded flex items-center justify-center border-2 {{ request('seasonal') ? 'bg-emerald-500 border-emerald-500' : 'border-gray-300 dark:border-gray-600' }} transition" aria-hidden="true">
                                    @if(request('seasonal'))
                                        <i class="ph-bold ph-check text-white text-xs"></i>
                                    @endif
                                </span>
                                <i class="ph-fill ph-clock text-amber-500 text-sm" aria-hidden="true"></i>
                                Seasonal Only
                            </a>
                        </li>
                    </ul>

                    @if(request()->anyFilled(['category', 'search', 'organic', 'seasonal']))
                        <a href="{{ route('shop.index') }}" class="mt-5 inline-flex items-center gap-1.5 text-sm text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 font-medium transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500">
                            <i class="ph-bold ph-arrow-left" aria-hidden="true"></i>
                            Clear Filters
                        </a>
                    @endif
                </div>
            </aside>

            <div class="flex-1 min-w-0">
                @if ($products->count())
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5" role="list" aria-label="Products">
                        @foreach ($products as $i => $product)
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
                                 x-data="{ quickShow: false, adding: false }" role="listitem">
                                <div class="h-48 bg-gradient-to-br from-emerald-100 via-green-50 to-emerald-50 dark:from-gray-800 dark:via-gray-800 dark:to-gray-900 relative overflow-hidden shrink-0">
                                     <img src="https://images.unsplash.com/{{ $imgId }}?w=300&q=50&fit=crop&auto=format"
                                          alt="{{ $product->name }}"
                                          loading="lazy"
                                          onerror="this.remove()"
                                          class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                                     <div class="absolute inset-0 bg-black/0 group-hover:bg-black/10 transition-colors duration-300"></div>
                                     <div class="absolute top-3 right-3 flex flex-col gap-1.5">
                                         @auth
                                             <form action="{{ route('wishlist.toggle', $product) }}" method="POST" class="m-0 p-0">
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
                                        <div class="flex items-center gap-2 mt-1 mb-3">
                                            <span class="text-xs text-gray-400 dark:text-gray-500 flex items-center gap-1">
                                                <i class="ph-bold ph-shopping-bag" aria-hidden="true"></i>
                                                Min. {{ $product->min_order }} {{ $product->unit }}
                                            </span>
                                            <span class="text-xs text-gray-400 dark:text-gray-500 flex items-center gap-1">
                                                <i class="ph-bold ph-speedometer" aria-hidden="true"></i>
                                                {{ $product->weight_in_grams }}g
                                            </span>
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

                    <div class="mt-10">
                        {{ $products->appends(request()->query())->links() }}
                    </div>
                @else
                    <div class="text-center py-20 bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800">
                        <i class="ph-bold ph-package text-6xl text-gray-300 dark:text-gray-600 mb-4" aria-hidden="true"></i>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">No products found</h3>
                        <p class="text-gray-500 dark:text-gray-400 text-sm">Try adjusting your search or filter criteria</p>
                        <a href="{{ route('shop.index') }}" class="mt-4 inline-flex items-center gap-1.5 text-sm text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 font-medium transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500">
                            <i class="ph-bold ph-arrow-left" aria-hidden="true"></i>
                            Clear Filters
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Mobile Filter Drawer --}}
    <div x-data="mobileFilters" @open-mobile-filters.window="open = true" @keydown.escape.window="close()">
        <div x-show="open" x-cloak class="fixed inset-0 z-50 lg:hidden" role="dialog" aria-modal="true" aria-label="Filter products">
            <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" class="fixed inset-0 bg-black/50" @click="close()" aria-hidden="true"></div>
            <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="translate-y-full" x-transition:enter-end="translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="translate-y-0" x-transition:leave-end="translate-y-full" class="filter-drawer open relative">
                <div class="sticky top-0 bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800 px-5 py-4 flex items-center justify-between rounded-t-2xl">
                    <h3 class="font-semibold text-gray-900 dark:text-white flex items-center gap-2">
                        <i class="ph-bold ph-funnel text-emerald-500" aria-hidden="true"></i>
                        Filters
                    </h3>
                    <button @click="close()" class="w-8 h-8 flex items-center justify-center rounded-lg text-gray-500 hover:bg-gray-100 dark:hover:bg-gray-800 transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500" aria-label="Close filters">
                        <i class="ph-bold ph-x text-lg" aria-hidden="true"></i>
                    </button>
                </div>
                <div class="p-5">
                    <form method="GET" action="{{ route('shop.index') }}" id="mobile-filter-form">
                        <div class="mb-5">
                            <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Categories</h4>
                            <div class="space-y-1.5">
                                <a href="{{ route('shop.index', array_merge(request()->except('category'), ['category' => ''])) }}"
                                   class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm transition {{ !request('category') ? 'bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 font-medium' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800' }}">
                                    All Categories
                                </a>
                                @foreach ($categories as $cat)
                                    <a href="{{ route('shop.index', array_merge(request()->except('category'), ['category' => $cat->slug])) }}"
                                       class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm transition {{ request('category') === $cat->slug ? 'bg-emerald-50 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 font-medium' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800' }}">
                                        {{ $cat->name }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <h4 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Product Labels</h4>
                        <div class="space-y-2">
                            <a href="{{ route('shop.index', array_merge(request()->except('organic'), ['organic' => request('organic') ? '' : '1'])) }}"
                               class="flex items-center gap-2 text-sm transition {{ request('organic') ? 'text-emerald-600 dark:text-emerald-400 font-medium' : 'text-gray-600 dark:text-gray-400' }}">
                                <span class="w-5 h-5 rounded flex items-center justify-center border-2 {{ request('organic') ? 'bg-emerald-500 border-emerald-500' : 'border-gray-300 dark:border-gray-600' }} transition">
                                    @if(request('organic'))
                                        <i class="ph-bold ph-check text-white text-xs"></i>
                                    @endif
                                </span>
                                <i class="ph-fill ph-seal-check text-emerald-500 text-sm" aria-hidden="true"></i>
                                Organic Only
                            </a>
                            <a href="{{ route('shop.index', array_merge(request()->except('seasonal'), ['seasonal' => request('seasonal') ? '' : '1'])) }}"
                               class="flex items-center gap-2 text-sm transition {{ request('seasonal') ? 'text-emerald-600 dark:text-emerald-400 font-medium' : 'text-gray-600 dark:text-gray-400' }}">
                                <span class="w-5 h-5 rounded flex items-center justify-center border-2 {{ request('seasonal') ? 'bg-emerald-500 border-emerald-500' : 'border-gray-300 dark:border-gray-600' }} transition">
                                    @if(request('seasonal'))
                                        <i class="ph-bold ph-check text-white text-xs"></i>
                                    @endif
                                </span>
                                <i class="ph-fill ph-clock text-amber-500 text-sm" aria-hidden="true"></i>
                                Seasonal Only
                            </a>
                        </div>
                        @if(request()->anyFilled(['category', 'search', 'organic', 'seasonal']))
                            <a href="{{ route('shop.index') }}" class="mt-5 inline-flex items-center gap-1.5 text-sm text-emerald-600 dark:text-emerald-400 font-medium transition">
                                <i class="ph-bold ph-arrow-left" aria-hidden="true"></i>
                                Clear Filters
                            </a>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>