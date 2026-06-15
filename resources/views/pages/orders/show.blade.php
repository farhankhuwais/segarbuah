<x-app-layout title="Order Detail">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <a href="{{ route('orders.index') }}" class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400 hover:text-emerald-600 dark:hover:text-emerald-400 transition mb-6">
            <i class="ph-bold ph-arrow-left text-xs" aria-hidden="true"></i>
            Back to Orders
        </a>

        <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-2 flex items-center gap-3">
            <i class="ph-bold ph-receipt text-emerald-500" aria-hidden="true"></i>
            Order #{{ $order->order_number }}
        </h1>
        <p class="text-sm text-gray-500 dark:text-gray-400 mb-8">{{ $order->created_at->format('d M Y, H:i') }}</p>

        @if (session('success'))
            <div class="mb-6 p-4 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 rounded-xl text-sm text-emerald-700 dark:text-emerald-300 flex items-center gap-2">
                <i class="ph-bold ph-check-circle text-lg" aria-hidden="true"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-6 mb-6 transition-colors">
            <h3 class="font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2 text-sm">
                <i class="ph-bold ph-package text-emerald-500" aria-hidden="true"></i>
                Items
            </h3>
            <div class="space-y-3">
                @foreach ($order->items as $item)
                    <div class="flex justify-between items-center text-sm">
                        <div>
                            <span class="text-gray-900 dark:text-white font-medium">{{ $item->product_name }}</span>
                            <span class="text-gray-400"> x{{ $item->quantity }}</span>
                        </div>
                        <span class="text-gray-600 dark:text-gray-400">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
                    </div>
                @endforeach
            </div>
            <div class="border-t border-gray-200 dark:border-gray-700 mt-4 pt-4 space-y-2 text-sm">
                <div class="flex justify-between text-gray-600 dark:text-gray-400">
                    <span>Subtotal</span>
                    <span>Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                </div>
                <div class="flex justify-between text-gray-600 dark:text-gray-400">
                    <span>Shipping</span>
                    <span>{{ $order->shipping_cost > 0 ? 'Rp '.number_format($order->shipping_cost, 0, ',', '.') : 'FREE' }}</span>
                </div>
            </div>
            <div class="border-t border-gray-200 dark:border-gray-700 mt-4 pt-4 flex justify-between items-center">
                <span class="font-bold text-gray-900 dark:text-white">Total</span>
                <span class="text-xl font-bold text-emerald-600 dark:text-emerald-400">Rp {{ number_format($order->total, 0, ',', '.') }}</span>
            </div>
        </div>

        <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-6 mb-6 transition-colors">
            <h3 class="font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2 text-sm">
                <i class="ph-bold ph-map-pin text-emerald-500" aria-hidden="true"></i>
                Shipping Address
            </h3>
            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $order->shipping_name }}</p>
            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $order->shipping_phone }}</p>
            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $order->shipping_address }}, {{ $order->shipping_city }} {{ $order->shipping_postal_code }}</p>
            @if ($order->notes)
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-3 italic">"{{ $order->notes }}"</p>
            @endif
        </div>

        <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-6 mb-6 transition-colors">
            <h3 class="font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2 text-sm">
                <i class="ph-bold ph-credit-card text-emerald-500" aria-hidden="true"></i>
                Payment
            </h3>
            <p class="text-sm text-gray-600 dark:text-gray-400 capitalize">{{ str_replace('_', ' ', $order->payment_method) }}</p>
            <div class="mt-2 flex items-center gap-2">
                <span class="text-sm text-gray-600 dark:text-gray-400">Status:</span>
                <span class="inline-block px-3 py-0.5 rounded-full text-xs font-semibold
                    @switch($order->payment_status)
                        @case('pending') bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-300 @break
                        @case('paid') bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300 @break
                        @case('failed') bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300 @break
                        @case('refunded') bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-300 @break
                        @default bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-300
                    @endswitch
                ">
                    {{ ucfirst($order->payment_status) }}
                </span>
            </div>

            @if ($order->payment_method === 'bank_transfer' && $order->payment_status === 'pending')
                <div class="mt-4 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-xl">
                    <p class="text-sm text-blue-700 dark:text-blue-300 flex items-start gap-2">
                        <i class="ph-bold ph-info mt-0.5" aria-hidden="true"></i>
                        Transfer the total to:<br>
                        <strong>BCA: 123-456-7890</strong> a.n. PT SegarBuah Indonesia
                    </p>
                </div>
                <form action="{{ route('orders.confirm', $order) }}" method="POST" class="mt-4">
                    @csrf
                    <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-3 rounded-xl transition shadow-sm text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500 flex items-center justify-center gap-2">
                        <i class="ph-bold ph-check-circle" aria-hidden="true"></i>
                        I've Transferred — Confirm Payment
                    </button>
                </form>
            @endif

            @if ($order->payment_method === 'qris' && $order->payment_status === 'pending')
                <div class="mt-4 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-xl">
                    <p class="text-sm text-blue-700 dark:text-blue-300 flex items-start gap-2">
                        <i class="ph-bold ph-info mt-0.5" aria-hidden="true"></i>
                        Scan the QRIS code sent via WhatsApp or visit our store to complete payment.
                    </p>
                </div>
            @endif
        </div>

        <div class="flex justify-between items-center">
            <a href="{{ route('shop.index') }}" class="text-sm text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 transition inline-flex items-center gap-1.5">
                <i class="ph-bold ph-arrow-left text-xs" aria-hidden="true"></i>
                Continue Shopping
            </a>
        </div>
    </div>
</x-app-layout>
