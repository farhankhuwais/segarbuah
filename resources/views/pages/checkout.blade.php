<x-app-layout title="Checkout">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="scroll-reveal mb-8">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white">Checkout</h1>
            <p class="text-gray-500 dark:text-gray-400 mt-1">Complete your order details</p>
        </div>

        <form action="{{ route('checkout.store') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            @csrf

            <div class="lg:col-span-2 space-y-6">
                <div class="scroll-reveal stagger-1 bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-6 transition-colors">
                    <h2 class="font-bold text-gray-900 dark:text-white mb-5 flex items-center gap-2">
                        <i class="ph-bold ph-map-pin text-emerald-500" aria-hidden="true"></i>
                        Shipping Address
                    </h2>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label for="shipping_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Full Name</label>
                            <input type="text" name="shipping_name" id="shipping_name" value="{{ old('shipping_name', auth()->user()?->name ?? '') }}" required
                                   class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition placeholder-gray-400 dark:placeholder-gray-500"
                                    placeholder="Enter your full name">
                            @error('shipping_name') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="shipping_phone" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Phone Number</label>
                            <input type="tel" name="shipping_phone" id="shipping_phone" value="{{ old('shipping_phone') }}" required
                                   class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition placeholder-gray-400 dark:placeholder-gray-500"
                                    placeholder="e.g. 081234567890">
                            @error('shipping_phone') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="sm:col-span-2">
                            <label for="shipping_address" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Address</label>
                            <textarea name="shipping_address" id="shipping_address" rows="3" required
                                      class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition placeholder-gray-400 dark:placeholder-gray-500"
                                      placeholder="Street name, building, house number">{{ old('shipping_address') }}</textarea>
                            @error('shipping_address') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="shipping_city" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">City</label>
                            <input type="text" name="shipping_city" id="shipping_city" value="{{ old('shipping_city') }}" required
                                   class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition placeholder-gray-400 dark:placeholder-gray-500"
                                    placeholder="e.g. Jakarta">
                            @error('shipping_city') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="shipping_postal_code" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Postal Code</label>
                            <input type="text" name="shipping_postal_code" id="shipping_postal_code" value="{{ old('shipping_postal_code') }}" required
                                   class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition placeholder-gray-400 dark:placeholder-gray-500"
                                    placeholder="e.g. 12345">
                            @error('shipping_postal_code') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <div class="scroll-reveal stagger-2 bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-6 transition-colors">
                    <h2 class="font-bold text-gray-900 dark:text-white mb-5 flex items-center gap-2">
                        <i class="ph-bold ph-note-pencil text-emerald-500" aria-hidden="true"></i>
                        Order Notes
                    </h2>
                    <textarea name="notes" id="notes" rows="3"
                              class="w-full px-4 py-2.5 border border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-100 rounded-xl text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition placeholder-gray-400 dark:placeholder-gray-500"
                              placeholder="Delivery instructions, special requests...">{{ old('notes') }}</textarea>
                </div>

                <div class="scroll-reveal stagger-3 bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-6 transition-colors">
                    <h2 class="font-bold text-gray-900 dark:text-white mb-5 flex items-center gap-2">
                        <i class="ph-bold ph-credit-card text-emerald-500" aria-hidden="true"></i>
                        Payment Method
                    </h2>
                    <div class="space-y-3">
                        <label class="flex items-center gap-3 p-4 border border-gray-200 dark:border-gray-700 rounded-xl cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-800 transition has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50 dark:has-[:checked]:bg-emerald-900/20">
                            <input type="radio" name="payment_method" value="bank_transfer" checked class="accent-emerald-600">
                            <div>
                                <p class="font-medium text-gray-900 dark:text-white text-sm">Bank Transfer</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Transfer to BCA / Mandiri / BNI</p>
                            </div>
                        </label>
                        <label class="flex items-center gap-3 p-4 border border-gray-200 dark:border-gray-700 rounded-xl cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-800 transition has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50 dark:has-[:checked]:bg-emerald-900/20">
                            <input type="radio" name="payment_method" value="cod" class="accent-emerald-600">
                            <div>
                                <p class="font-medium text-gray-900 dark:text-white text-sm">Cash on Delivery (COD)</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Pay when you receive</p>
                            </div>
                        </label>
                        <label class="flex items-center gap-3 p-4 border border-gray-200 dark:border-gray-700 rounded-xl cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-800 transition has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50 dark:has-[:checked]:bg-emerald-900/20">
                            <input type="radio" name="payment_method" value="qris" class="accent-emerald-600">
                            <div>
                                <p class="font-medium text-gray-900 dark:text-white text-sm">QRIS</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Scan QR with any e-wallet</p>
                            </div>
                        </label>
                    </div>
                    @error('payment_method') <p class="text-xs text-red-500 mt-2">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="scroll-reveal stagger-3">
                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-6 sticky top-20 transition-colors">
                    <h3 class="font-bold text-gray-900 dark:text-white mb-4">Order Summary</h3>
                    <div class="space-y-3 text-sm max-h-60 overflow-y-auto">
                        @foreach ($items as $id => $item)
                            <div class="flex justify-between text-gray-600 dark:text-gray-400">
                                <span class="truncate max-w-[180px]">{{ $item['name'] }} <span class="text-gray-400 dark:text-gray-500">x{{ $item['quantity'] }}</span></span>
                                <span>Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                    </div>
                    <div class="border-t border-gray-200 dark:border-gray-700 mt-4 pt-4 space-y-2 text-sm">
                        <div class="flex justify-between text-gray-600 dark:text-gray-400">
                            <span>Subtotal</span>
                            <span>Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-gray-600 dark:text-gray-400">
                            <span>Shipping</span>
                            <span class="{{ $total >= 100000 ? 'text-emerald-600' : '' }}">{{ $total >= 100000 ? 'FREE' : 'Rp 15.000' }}</span>
                        </div>
                    </div>
                    <div class="border-t border-gray-200 dark:border-gray-700 mt-4 pt-4 flex justify-between items-center">
                        <span class="font-bold text-gray-900 dark:text-white">Total</span>
                        <span class="text-xl font-bold text-emerald-600 dark:text-emerald-400">Rp {{ number_format($total >= 100000 ? $total : $total + 15000, 0, ',', '.') }}</span>
                    </div>
                    @if ($total < 100000)
                        <p class="text-xs text-amber-600 dark:text-amber-400 mt-2 flex items-center gap-1">
                            <i class="ph-bold ph-truck" aria-hidden="true"></i>
                            Add Rp {{ number_format(100000 - $total, 0, ',', '.') }} more for free shipping
                        </p>
                    @else
                        <p class="text-xs text-emerald-600 dark:text-emerald-400 mt-2 flex items-center gap-1">
                            <i class="ph-bold ph-seal-check" aria-hidden="true"></i>
                            Free shipping applied
                        </p>
                    @endif
                    <button type="submit" class="mt-5 w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-3 rounded-xl transition shadow-sm text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500">
                        <i class="ph-bold ph-check-circle me-1.5" aria-hidden="true"></i>
                        Place Order
                    </button>
                    <a href="{{ route('cart.index') }}" class="mt-3 block text-center text-sm text-gray-500 dark:text-gray-400 hover:text-emerald-600 dark:hover:text-emerald-400 transition py-2">
                        <i class="ph-bold ph-arrow-left me-1" aria-hidden="true"></i>
                        Back to Cart
                    </a>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>