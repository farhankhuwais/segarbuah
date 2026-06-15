<x-app-layout title="Order Detail">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="flex flex-col lg:flex-row gap-6">
            <x-admin-sidebar />
            <div class="flex-1 min-w-0">
                <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400 hover:text-emerald-600 dark:hover:text-emerald-400 transition mb-6">
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

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    <div class="lg:col-span-2 space-y-6">

                        <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-6 transition-colors">
                            <h3 class="font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2 text-sm">
                                <i class="ph-bold ph-package text-emerald-500" aria-hidden="true"></i>
                                Items
                            </h3>
                            <div class="space-y-3 text-sm">
                                @foreach ($order->items as $item)
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <span class="text-gray-900 dark:text-white font-medium">{{ $item->product_name }}</span>
                                            <span class="text-gray-400 dark:text-gray-500"> x{{ $item->quantity }}</span>
                                            @if ($item->product)
                                                <a href="{{ route('shop.show', $item->product) }}" class="text-emerald-600 dark:text-emerald-400 hover:underline ml-2 text-xs">View</a>
                                            @endif
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

                        <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-6 transition-colors">
                            <h3 class="font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2 text-sm">
                                <i class="ph-bold ph-map-pin text-emerald-500" aria-hidden="true"></i>
                                Shipping Address
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $order->shipping_name }} ({{ $order->shipping_phone }})</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $order->shipping_address }}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400">{{ $order->shipping_city }} {{ $order->shipping_postal_code }}</p>
                            @if ($order->notes)
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-3 italic">"{{ $order->notes }}"</p>
                            @endif
                        </div>

                    </div>

                    <div class="space-y-6">

                        <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-6 transition-colors">
                            <h3 class="font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2 text-sm">
                                <i class="ph-bold ph-shopping-cart text-emerald-500" aria-hidden="true"></i>
                                Order Status
                            </h3>
                            <form action="{{ route('admin.orders.status', $order) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="status" class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:border-emerald-500 focus:ring-emerald-500 px-4 py-2.5 mb-3">
                                    <option value="pending" @selected($order->status === 'pending')>Pending</option>
                                    <option value="confirmed" @selected($order->status === 'confirmed')>Confirmed</option>
                                    <option value="processing" @selected($order->status === 'processing')>Processing</option>
                                    <option value="shipped" @selected($order->status === 'shipped')>Shipped</option>
                                    <option value="delivered" @selected($order->status === 'delivered')>Delivered</option>
                                    <option value="cancelled" @selected($order->status === 'cancelled')>Cancelled</option>
                                </select>
                                <button type="submit" class="w-full bg-gray-900 dark:bg-white text-white dark:text-gray-900 hover:bg-gray-800 dark:hover:bg-gray-200 font-semibold py-2 rounded-xl text-sm transition">Update Status</button>
                            </form>
                        </div>

                        <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-6 transition-colors">
                            <h3 class="font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2 text-sm">
                                <i class="ph-bold ph-credit-card text-emerald-500" aria-hidden="true"></i>
                                Payment
                            </h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 capitalize mb-2">{{ str_replace('_', ' ', $order->payment_method) }}</p>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">
                                Current: <span class="font-medium text-amber-600 capitalize">{{ $order->payment_status }}</span>
                            </p>
                            <form action="{{ route('admin.orders.payment', $order) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="payment_status" class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:border-emerald-500 focus:ring-emerald-500 px-4 py-2.5 mb-3">
                                    <option value="pending" @selected($order->payment_status === 'pending')>Pending</option>
                                    <option value="paid" @selected($order->payment_status === 'paid')>Paid</option>
                                    <option value="failed" @selected($order->payment_status === 'failed')>Failed</option>
                                    <option value="refunded" @selected($order->payment_status === 'refunded')>Refunded</option>
                                </select>
                                <button type="submit" class="w-full bg-gray-900 dark:bg-white text-white dark:text-gray-900 hover:bg-gray-800 dark:hover:bg-gray-200 font-semibold py-2 rounded-xl text-sm transition">Update Payment</button>
                            </form>
                        </div>

                        @if ($order->user)
                            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-6 transition-colors">
                                <h3 class="font-bold text-gray-900 dark:text-white mb-2 flex items-center gap-2 text-sm">
                                    <i class="ph-bold ph-user text-emerald-500" aria-hidden="true"></i>
                                    Customer
                                </h3>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $order->user->name }}</p>
                                <p class="text-sm text-gray-600 dark:text-gray-400">{{ $order->user->email }}</p>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
            <div class="lg:col-span-2 space-y-6">

                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-6 transition-colors">
                    <h3 class="font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2 text-sm">
                        <i class="ph-bold ph-package text-emerald-500" aria-hidden="true"></i>
                        Items
                    </h3>
                    <div class="space-y-3 text-sm">
                        @foreach ($order->items as $item)
                            <div class="flex justify-between items-center">
                                <div>
                                    <span class="text-gray-900 dark:text-white font-medium">{{ $item->product_name }}</span>
                                    <span class="text-gray-400 dark:text-gray-500"> x{{ $item->quantity }}</span>
                                    @if ($item->product)
                                        <a href="{{ route('shop.show', $item->product) }}" class="text-emerald-600 dark:text-emerald-400 hover:underline ml-2 text-xs">View</a>
                                    @endif
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

                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-6 transition-colors">
                    <h3 class="font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2 text-sm">
                        <i class="ph-bold ph-map-pin text-emerald-500" aria-hidden="true"></i>
                        Shipping Address
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $order->shipping_name }} ({{ $order->shipping_phone }})</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $order->shipping_address }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400">{{ $order->shipping_city }} {{ $order->shipping_postal_code }}</p>
                    @if ($order->notes)
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-3 italic">"{{ $order->notes }}"</p>
                    @endif
                </div>

            </div>

            <div class="space-y-6">

                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-6 transition-colors">
                    <h3 class="font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2 text-sm">
                        <i class="ph-bold ph-shopping-cart text-emerald-500" aria-hidden="true"></i>
                        Order Status
                    </h3>
                    <form action="{{ route('admin.orders.status', $order) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <select name="status" class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:border-emerald-500 focus:ring-emerald-500 px-4 py-2.5 mb-3">
                            <option value="pending" @selected($order->status === 'pending')>Pending</option>
                            <option value="confirmed" @selected($order->status === 'confirmed')>Confirmed</option>
                            <option value="processing" @selected($order->status === 'processing')>Processing</option>
                            <option value="shipped" @selected($order->status === 'shipped')>Shipped</option>
                            <option value="delivered" @selected($order->status === 'delivered')>Delivered</option>
                            <option value="cancelled" @selected($order->status === 'cancelled')>Cancelled</option>
                        </select>
                        <button type="submit" class="w-full bg-gray-900 dark:bg-white text-white dark:text-gray-900 hover:bg-gray-800 dark:hover:bg-gray-200 font-semibold py-2 rounded-xl text-sm transition">Update Status</button>
                    </form>
                </div>

                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-6 transition-colors">
                    <h3 class="font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2 text-sm">
                        <i class="ph-bold ph-credit-card text-emerald-500" aria-hidden="true"></i>
                        Payment
                    </h3>
                    <p class="text-sm text-gray-600 dark:text-gray-400 capitalize mb-2">{{ str_replace('_', ' ', $order->payment_method) }}</p>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mb-3">
                        Current: <span class="font-medium text-amber-600 capitalize">{{ $order->payment_status }}</span>
                    </p>
                    <form action="{{ route('admin.orders.payment', $order) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <select name="payment_status" class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white text-sm focus:border-emerald-500 focus:ring-emerald-500 px-4 py-2.5 mb-3">
                            <option value="pending" @selected($order->payment_status === 'pending')>Pending</option>
                            <option value="paid" @selected($order->payment_status === 'paid')>Paid</option>
                            <option value="failed" @selected($order->payment_status === 'failed')>Failed</option>
                            <option value="refunded" @selected($order->payment_status === 'refunded')>Refunded</option>
                        </select>
                        <button type="submit" class="w-full bg-gray-900 dark:bg-white text-white dark:text-gray-900 hover:bg-gray-800 dark:hover:bg-gray-200 font-semibold py-2 rounded-xl text-sm transition">Update Payment</button>
                    </form>
                </div>

                @if ($order->user)
                    <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-6 transition-colors">
                        <h3 class="font-bold text-gray-900 dark:text-white mb-2 flex items-center gap-2 text-sm">
                            <i class="ph-bold ph-user text-emerald-500" aria-hidden="true"></i>
                            Customer
                        </h3>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $order->user->name }}</p>
                        <p class="text-sm text-gray-600 dark:text-gray-400">{{ $order->user->email }}</p>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
