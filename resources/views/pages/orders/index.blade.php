<x-app-layout title="My Orders">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-8 flex items-center gap-3">
            <i class="ph-bold ph-package text-emerald-500" aria-hidden="true"></i>
            My Orders
        </h1>

        @if (session('success'))
            <div class="mb-6 p-4 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 rounded-xl text-sm text-emerald-700 dark:text-emerald-300 flex items-center gap-2">
                <i class="ph-bold ph-check-circle text-lg" aria-hidden="true"></i>
                {{ session('success') }}
            </div>
        @endif

        @forelse ($orders as $order)
            <a href="{{ route('orders.show', $order) }}" class="block bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-5 mb-4 hover:shadow-md transition shadow-sm">
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <div>
                        <p class="text-sm font-bold text-gray-900 dark:text-white">{{ $order->order_number }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">{{ $order->created_at->format('d M Y, H:i') }}</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">{{ $order->items_count }} item(s) &middot; Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                    </div>
                    <div class="text-right">
                        <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold
                            @switch($order->status)
                                @case('pending') bg-yellow-100 text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-300 @break
                                @case('confirmed') bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300 @break
                                @case('processing') bg-cyan-100 text-cyan-700 dark:bg-cyan-900/30 dark:text-cyan-300 @break
                                @case('shipped') bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-300 @break
                                @case('delivered') bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300 @break
                                @case('cancelled') bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300 @break
                                @default bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-300
                            @endswitch
                        ">
                            {{ ucfirst($order->status) }}
                        </span>
                        <p class="text-xs text-gray-500 dark:text-gray-400 mt-1 capitalize">{{ str_replace('_', ' ', $order->payment_method) }}</p>
                    </div>
                </div>
            </a>
        @empty
            <div class="text-center py-16">
                <i class="ph-bold ph-package text-6xl text-gray-300 dark:text-gray-600 mb-4" aria-hidden="true"></i>
                <p class="text-gray-500 dark:text-gray-400 mb-6">No orders yet.</p>
                <a href="{{ route('shop.index') }}" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-6 py-3 rounded-xl transition shadow-sm">
                    <i class="ph-bold ph-shopping-bag" aria-hidden="true"></i>
                    Start Shopping
                </a>
            </div>
        @endforelse

        <div class="mt-6">
            {{ $orders->links() }}
        </div>
    </div>
</x-app-layout>
