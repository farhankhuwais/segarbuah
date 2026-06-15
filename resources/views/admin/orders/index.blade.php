<x-app-layout title="Orders Management">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="flex flex-col lg:flex-row gap-6">
            <x-admin-sidebar />
            <div class="flex-1 min-w-0">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-8 flex items-center gap-3">
                    <i class="ph-bold ph-package text-emerald-500" aria-hidden="true"></i>
                    Orders Management
                </h1>

                @if (session('success'))
                    <div class="mb-6 p-4 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800 rounded-xl text-sm text-emerald-700 dark:text-emerald-300 flex items-center gap-2">
                        <i class="ph-bold ph-check-circle text-lg" aria-hidden="true"></i>
                        {{ session('success') }}
                    </div>
                @endif

                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 overflow-hidden transition-colors">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-gray-50 dark:bg-gray-800/50 border-b border-gray-200 dark:border-gray-800">
                                <tr>
                                    <th class="text-left px-6 py-3 font-semibold text-gray-900 dark:text-white">Order</th>
                                    <th class="text-left px-6 py-3 font-semibold text-gray-900 dark:text-white">Customer</th>
                                    <th class="text-left px-6 py-3 font-semibold text-gray-900 dark:text-white">Items</th>
                                    <th class="text-left px-6 py-3 font-semibold text-gray-900 dark:text-white">Total</th>
                                    <th class="text-left px-6 py-3 font-semibold text-gray-900 dark:text-white">Payment</th>
                                    <th class="text-left px-6 py-3 font-semibold text-gray-900 dark:text-white">Status</th>
                                    <th class="text-left px-6 py-3 font-semibold text-gray-900 dark:text-white">Date</th>
                                    <th class="text-right px-6 py-3 font-semibold text-gray-900 dark:text-white">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                @forelse ($orders as $order)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/30 transition">
                                        <td class="px-6 py-4 font-mono text-xs font-bold text-gray-900 dark:text-white">{{ $order->order_number }}</td>
                                        <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $order->shipping_name }}</td>
                                        <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $order->items_count }}</td>
                                        <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4">
                                            <span class="inline-block px-2 py-0.5 rounded-full text-xs font-semibold whitespace-nowrap
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
                                        </td>
                                        <td class="px-6 py-4">
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
                                        <td class="px-6 py-4 text-xs text-gray-500 dark:text-gray-400 whitespace-nowrap">{{ $order->created_at->format('d M Y') }}</td>
                                        <td class="px-6 py-4 text-right">
                                            <a href="{{ route('admin.orders.show', $order) }}" class="text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 font-medium text-sm inline-flex items-center gap-1">
                                                Detail
                                                <i class="ph-bold ph-arrow-right text-xs" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-6 py-16 text-center text-gray-500 dark:text-gray-400">
                                            <i class="ph-bold ph-package text-4xl mb-2 block" aria-hidden="true"></i>
                                            No orders found.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-6">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
