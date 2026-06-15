<x-app-layout title="Cart">
    <div x-data="{ updating: null }" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="scroll-reveal mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Shopping Cart</h1>
            <p class="text-gray-500 dark:text-gray-400 mt-1">{{ $cartCount }} item(s) in your cart</p>
        </div>

        @if (count($items))
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2 space-y-4">
                    @foreach ($items as $id => $item)
                        <div class="scroll-reveal stagger-{{ min($loop->index, 3) + 1 }} bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-4 flex items-center gap-4 transition-colors">
                            <a href="{{ route('shop.show', $item['slug']) }}" class="shrink-0">
                                <div class="w-20 h-20 bg-gradient-to-br from-emerald-100 via-green-50 to-emerald-50 dark:from-gray-800 dark:via-gray-800 dark:to-gray-900 rounded-xl overflow-hidden">
                                    <img src="https://images.unsplash.com/{{ $item['image'] }}?w=100&q=50&fit=crop&auto=format"
                                         alt="{{ $item['name'] }}"
                                         loading="lazy"
                                         onerror="this.remove()"
                                         class="w-full h-full object-cover">
                                </div>
                            </a>
                            <div class="flex-1 min-w-0">
                                <a href="{{ route('shop.show', $item['slug']) }}" class="font-semibold text-gray-900 dark:text-white hover:text-emerald-600 dark:hover:text-emerald-400 transition text-sm block truncate">{{ $item['name'] }}</a>
                                <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">{{ $item['weight'] }}g / {{ $item['unit'] }}</p>
                                <p class="text-sm font-bold text-emerald-600 dark:text-emerald-400 mt-1">Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="flex items-center border border-gray-300 dark:border-gray-600 rounded-lg overflow-hidden">
                                    <button @click="updating = {{ $id }}; fetch('{{ route('cart.update', $id) }}', { method: 'PATCH', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json', 'Accept': 'application/json' }, body: JSON.stringify({ quantity: Math.max(1, {{ $item['quantity'] }} - 1) }) }).then(r => r.json()).then(d => { if(d.success) location.reload() })" class="w-8 h-8 flex items-center justify-center text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition" aria-label="Decrease">
                                        <i class="ph-bold ph-minus text-xs" aria-hidden="true"></i>
                                    </button>
                                    <span class="w-9 h-8 flex items-center justify-center text-sm font-semibold text-gray-900 dark:text-white border-x border-gray-300 dark:border-gray-600">{{ $item['quantity'] }}</span>
                                    <button @click="fetch('{{ route('cart.update', $id) }}', { method: 'PATCH', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Content-Type': 'application/json', 'Accept': 'application/json' }, body: JSON.stringify({ quantity: {{ $item['quantity'] }} + 1 }) }).then(r => r.json()).then(d => { if(d.success) location.reload() })" class="w-8 h-8 flex items-center justify-center text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition" aria-label="Increase">
                                        <i class="ph-bold ph-plus text-xs" aria-hidden="true"></i>
                                    </button>
                                </div>
                                <div class="text-right min-w-[80px]">
                                    <p class="font-bold text-gray-900 dark:text-white text-sm">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</p>
                                    <button @click="fetch('{{ route('cart.destroy', $id) }}', { method: 'DELETE', headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}', 'Accept': 'application/json' } }).then(r => r.json()).then(d => { if(d.success) location.reload() })" class="text-xs text-red-500 hover:text-red-600 transition mt-1" aria-label="Remove {{ $item['name'] }}">
                                        <i class="ph-bold ph-trash me-0.5" aria-hidden="true"></i>
                                        Remove
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="scroll-reveal stagger-2">
                    <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-6 sticky top-20 transition-colors">
                        <h3 class="font-bold text-gray-900 dark:text-white text-lg mb-4">Order Summary</h3>
                        <div class="space-y-3 text-sm">
                            @foreach ($items as $item)
                                <div class="flex justify-between text-gray-600 dark:text-gray-400">
                                    <span class="truncate max-w-[180px]">{{ $item['name'] }} <span class="text-gray-400 dark:text-gray-500">x{{ $item['quantity'] }}</span></span>
                                    <span>Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span>
                                </div>
                            @endforeach
                        </div>
                        <div class="border-t border-gray-200 dark:border-gray-700 mt-4 pt-4 flex justify-between items-center">
                            <span class="font-bold text-gray-900 dark:text-white">Total</span>
                            <span class="text-xl font-bold text-emerald-600 dark:text-emerald-400">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <a href="{{ route('checkout.index') }}" class="mt-6 block w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-3 rounded-xl transition shadow-sm text-center text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500">
                            <i class="ph-bold ph-credit-card me-1.5" aria-hidden="true"></i>
                            Proceed to Checkout
                        </a>
                        <a href="{{ route('shop.index') }}" class="mt-3 block w-full text-center text-sm text-gray-500 dark:text-gray-400 hover:text-emerald-600 dark:hover:text-emerald-400 transition py-2">
                            <i class="ph-bold ph-arrow-left me-1" aria-hidden="true"></i>
                            Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="text-center py-20 bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 scroll-reveal">
                <i class="ph-bold ph-shopping-bag text-6xl text-gray-300 dark:text-gray-600 mb-4" aria-hidden="true"></i>
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-1">Your cart is empty</h3>
                <p class="text-gray-500 dark:text-gray-400 text-sm mb-6">Looks like you haven't added anything yet</p>
                <a href="{{ route('shop.index') }}" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-6 py-3 rounded-xl transition shadow-sm text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500">
                    <i class="ph-bold ph-shopping-cart" aria-hidden="true"></i>
                    Start Shopping
                </a>
            </div>
        @endif
    </div>
</x-app-layout>