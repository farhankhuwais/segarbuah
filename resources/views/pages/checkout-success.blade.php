<x-app-layout title="Order Success">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8 py-16 text-center scroll-reveal">
        <div class="w-20 h-20 bg-emerald-100 dark:bg-emerald-900/30 rounded-full flex items-center justify-center mx-auto mb-6">
            <i class="ph-bold ph-check-circle text-4xl text-emerald-600 dark:text-emerald-400" aria-hidden="true"></i>
        </div>
        <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-3">Order Placed!</h1>
        <p class="text-gray-500 dark:text-gray-400 mb-2">Thank you for your order.</p>
        <p class="text-sm text-gray-500 dark:text-gray-400 mb-8">
            Order number: <span class="font-bold text-emerald-600 dark:text-emerald-400">{{ $order->order_number }}</span>
        </p>

        <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-6 text-left mb-8 transition-colors">
            <h3 class="font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2">
                <i class="ph-bold ph-receipt text-emerald-500" aria-hidden="true"></i>
                Order Details
            </h3>
            <div class="space-y-3 text-sm">
                @foreach ($order->items as $item)
                    <div class="flex justify-between text-gray-600 dark:text-gray-400">
                        <span>{{ $item->product_name }} <span class="text-gray-400 dark:text-gray-500">x{{ $item->quantity }}</span></span>
                        <span>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</span>
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

            <div class="mt-6 p-4 bg-gray-50 dark:bg-gray-800 rounded-xl">
                <h4 class="font-medium text-gray-900 dark:text-white text-sm mb-3 flex items-center gap-2">
                    <i class="ph-bold ph-map-pin text-emerald-500" aria-hidden="true"></i>
                    Shipping Address
                </h4>
                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $order->shipping_name }}</p>
                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $order->shipping_phone }}</p>
                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $order->shipping_address }}, {{ $order->shipping_city }} {{ $order->shipping_postal_code }}</p>
            </div>

            <div class="mt-4 p-4 bg-gray-50 dark:bg-gray-800 rounded-xl">
                <h4 class="font-medium text-gray-900 dark:text-white text-sm mb-1 flex items-center gap-2">
                    <i class="ph-bold ph-credit-card text-emerald-500" aria-hidden="true"></i>
                    Payment
                </h4>
                <p class="text-sm text-gray-600 dark:text-gray-400 capitalize">{{ str_replace('_', ' ', $order->payment_method) }}</p>
                <p class="text-sm text-gray-600 dark:text-gray-400">Status: <span class="text-amber-600 font-medium capitalize">{{ $order->payment_status }}</span></p>
            </div>

            @if ($order->payment_method === 'bank_transfer')
                <div class="mt-4 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-xl">
                    <p class="text-sm text-blue-700 dark:text-blue-300 flex items-start gap-2">
                        <i class="ph-bold ph-info mt-0.5" aria-hidden="true"></i>
                        Please transfer the total amount to:<br>
                        <strong>BCA: 123-456-7890</strong> a.n. PT SegarBuah Indonesia
                    </p>
                </div>
            @elseif ($order->payment_method === 'qris')
                <div class="mt-4 p-4 bg-blue-50 dark:bg-blue-900/20 rounded-xl">
                    <p class="text-sm text-blue-700 dark:text-blue-300 flex items-start gap-2">
                        <i class="ph-bold ph-info mt-0.5" aria-hidden="true"></i>
                        Please scan the QRIS code at the store or wait for our team to send the QR code via WhatsApp.
                    </p>
                </div>
            @endif
        </div>

        <a href="{{ route('shop.index') }}" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-6 py-3 rounded-xl transition shadow-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500">
            <i class="ph-bold ph-shopping-bag" aria-hidden="true"></i>
            Continue Shopping
        </a>
    </div>
</x-app-layout>