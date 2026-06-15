<x-app-layout title="Admin Dashboard">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">

        <div class="flex items-center justify-between mb-8">
            <h1 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center gap-3">
                <i class="ph-bold ph-chart-bar text-emerald-500" aria-hidden="true"></i>
                Admin Dashboard
            </h1>
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ now()->format('l, d M Y') }}</p>
        </div>

        <div class="flex flex-col lg:flex-row gap-6">

            <x-admin-sidebar />

            {{-- Right Content Area --}}
            <div class="flex-1 min-w-0 space-y-6">

                {{-- Stat Cards --}}
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">

                    <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-4 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center shrink-0">
                                <i class="ph-bold ph-shopping-bag text-emerald-600 dark:text-emerald-400" aria-hidden="true"></i>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalOrders }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Total Orders</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-4 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center shrink-0">
                                <i class="ph-bold ph-currency-circle-dollar text-blue-600 dark:text-blue-400" aria-hidden="true"></i>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Revenue</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-4 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center shrink-0">
                                <i class="ph-bold ph-hourglass text-amber-600 dark:text-amber-400" aria-hidden="true"></i>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $pendingOrders }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Pending</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-4 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center shrink-0">
                                <i class="ph-bold ph-apple-logo text-purple-600 dark:text-purple-400" aria-hidden="true"></i>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalProducts }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Products</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-4 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-cyan-100 dark:bg-cyan-900/30 flex items-center justify-center shrink-0">
                                <i class="ph-bold ph-folder text-cyan-600 dark:text-cyan-400" aria-hidden="true"></i>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalCategories }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Categories</p>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-4 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl bg-pink-100 dark:bg-pink-900/30 flex items-center justify-center shrink-0">
                                <i class="ph-bold ph-users text-pink-600 dark:text-pink-400" aria-hidden="true"></i>
                            </div>
                            <div>
                                <p class="text-2xl font-bold text-gray-900 dark:text-white">{{ $totalUsers }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Users</p>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Charts Row --}}
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                    <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-6 transition-colors">
                        <h2 class="font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2 text-sm">
                            <i class="ph-bold ph-trend-up text-emerald-500" aria-hidden="true"></i>
                            Monthly Revenue ({{ now()->year }})
                        </h2>
                        @php
                            $maxRevenue = $monthlyRevenue->max() ?: 1;
                            $months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
                        @endphp
                        <div class="flex items-end gap-2 h-40">
                            @foreach (range(1, 12) as $m)
                                @php
                                    $val = $monthlyRevenue->get($m, 0);
                                    $pct = ($val / $maxRevenue) * 100;
                                @endphp
                                <div class="flex-1 flex flex-col items-center gap-1">
                                    <span class="text-[10px] font-medium text-gray-500 dark:text-gray-400 {{ $val == 0 ? 'opacity-0' : '' }}">
                                        {{ $val > 0 ? 'Rp'.number_format($val / 1000000, 1) : '0' }}
                                    </span>
                                    <div class="w-full bg-gray-100 dark:bg-gray-800 rounded-t-lg relative" style="height: 120px;">
                                        <div class="absolute bottom-0 left-0 right-0 bg-emerald-500 dark:bg-emerald-400 rounded-t-lg transition-all duration-500" style="height: {{ $pct }}%;"></div>
                                    </div>
                                    <span class="text-[10px] text-gray-500 dark:text-gray-400">{{ $months[$m - 1] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-6 transition-colors">
                        <h2 class="font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2 text-sm">
                            <i class="ph-bold ph-pie-chart text-emerald-500" aria-hidden="true"></i>
                            Orders by Status
                        </h2>
                        <div class="space-y-3">
                            @php
                                $statusColors = [
                                    'pending' => 'bg-yellow-500',
                                    'confirmed' => 'bg-blue-500',
                                    'processing' => 'bg-cyan-500',
                                    'shipped' => 'bg-purple-500',
                                    'delivered' => 'bg-emerald-500',
                                    'cancelled' => 'bg-red-500',
                                ];
                                $totalOrderCount = array_sum($ordersByStatus->toArray()) ?: 1;
                            @endphp
                            @foreach (['pending', 'confirmed', 'processing', 'shipped', 'delivered', 'cancelled'] as $s)
                                @php $count = $ordersByStatus->get($s, 0); $pct = ($count / $totalOrderCount) * 100; @endphp
                                <div>
                                    <div class="flex justify-between text-sm mb-1">
                                        <span class="text-gray-700 dark:text-gray-300 capitalize">{{ $s }}</span>
                                        <span class="text-gray-500 dark:text-gray-400">{{ $count }} ({{ number_format($pct, 1) }}%)</span>
                                    </div>
                                    <div class="w-full h-2 bg-gray-100 dark:bg-gray-800 rounded-full overflow-hidden">
                                        <div class="h-full rounded-full {{ $statusColors[$s] ?? 'bg-gray-500' }}" style="width: {{ $pct }}%"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>

                {{-- Recent Orders + Top Products --}}
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    <div class="lg:col-span-2 bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 overflow-hidden transition-colors">
                        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-800 flex items-center justify-between">
                            <h2 class="font-bold text-gray-900 dark:text-white flex items-center gap-2 text-sm">
                                <i class="ph-bold ph-clock text-emerald-500" aria-hidden="true"></i>
                                Recent Orders
                            </h2>
                            <a href="{{ route('admin.orders.index') }}" class="text-sm text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 font-medium inline-flex items-center gap-1">
                                View All
                                <i class="ph-bold ph-arrow-right text-xs" aria-hidden="true"></i>
                            </a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm">
                                <thead>
                                    <tr class="border-b border-gray-100 dark:border-gray-800">
                                        <th class="text-left px-6 py-3 font-semibold text-gray-900 dark:text-white">Order</th>
                                        <th class="text-left px-6 py-3 font-semibold text-gray-900 dark:text-white">Customer</th>
                                        <th class="text-left px-6 py-3 font-semibold text-gray-900 dark:text-white">Total</th>
                                        <th class="text-left px-6 py-3 font-semibold text-gray-900 dark:text-white">Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                    @forelse ($recentOrders as $order)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/30 transition">
                                            <td class="px-6 py-3 font-mono text-xs font-bold text-gray-900 dark:text-white">{{ $order->order_number }}</td>
                                            <td class="px-6 py-3 text-gray-600 dark:text-gray-400">{{ $order->shipping_name }}</td>
                                            <td class="px-6 py-3 font-medium text-gray-900 dark:text-white">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                                            <td class="px-6 py-3">
                                                <span class="inline-block px-2 py-0.5 rounded-full text-xs font-semibold whitespace-nowrap
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
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="px-6 py-10 text-center text-gray-500 dark:text-gray-400">No orders yet.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-6 transition-colors">
                        <h2 class="font-bold text-gray-900 dark:text-white mb-4 flex items-center gap-2 text-sm">
                            <i class="ph-bold ph-crown text-emerald-500" aria-hidden="true"></i>
                            Top Products
                        </h2>
                        <div class="space-y-4">
                            @forelse ($topProducts as $item)
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-gradient-to-br from-emerald-100 to-emerald-50 dark:from-gray-800 dark:to-gray-900 flex items-center justify-center shrink-0">
                                        <i class="ph-bold ph-seal-check text-emerald-500" aria-hidden="true"></i>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ $item->product_name }}</p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ $item->total_qty }} sold &middot; Rp {{ number_format($item->total_revenue, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            @empty
                                <p class="text-sm text-gray-500 dark:text-gray-400 text-center py-6">No sales yet.</p>
                            @endforelse
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>
