<x-app-layout title="Manage Products">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="flex flex-col lg:flex-row gap-6">
            <x-admin-sidebar />
            <div class="flex-1 min-w-0">
                <div class="flex items-center justify-between mb-8">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center gap-3">
                        <i class="ph-bold ph-apple-logo text-emerald-500" aria-hidden="true"></i>
                        Manage Products
                    </h1>
                    <a href="{{ route('admin.products.create') }}" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-4 py-2 rounded-xl text-sm transition shadow-sm">
                        <i class="ph-bold ph-plus-circle" aria-hidden="true"></i>
                        New Product
                    </a>
                </div>

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
                                    <th class="text-left px-6 py-3 font-semibold text-gray-900 dark:text-white">Name</th>
                                    <th class="text-left px-6 py-3 font-semibold text-gray-900 dark:text-white">Category</th>
                                    <th class="text-left px-6 py-3 font-semibold text-gray-900 dark:text-white">Price</th>
                                    <th class="text-left px-6 py-3 font-semibold text-gray-900 dark:text-white">Stock</th>
                                    <th class="text-left px-6 py-3 font-semibold text-gray-900 dark:text-white">Status</th>
                                    <th class="text-right px-6 py-3 font-semibold text-gray-900 dark:text-white">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                                @forelse ($products as $product)
                                    <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/30 transition">
                                        <td class="px-6 py-4">
                                            <p class="font-medium text-gray-900 dark:text-white">{{ $product->name }}</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">{{ $product->sku }}</p>
                                        </td>
                                        <td class="px-6 py-4 text-gray-600 dark:text-gray-400">{{ $product->category->name ?? '—' }}</td>
                                        <td class="px-6 py-4">
                                            <span class="font-medium text-gray-900 dark:text-white">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                            @if ($product->activeSale()->exists())
                                                <span class="block text-xs text-red-500">Sale: Rp {{ number_format($product->sale_price, 0, ',', '.') }}</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="{{ $product->stock > 0 ? 'text-emerald-600 dark:text-emerald-400' : 'text-red-500' }}">
                                                {{ $product->stock }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="inline-block px-2 py-0.5 rounded-full text-xs font-semibold {{ $product->is_active ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-300' : 'bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-300' }}">
                                                {{ $product->is_active ? 'Active' : 'Inactive' }}
                                            </span>
                                            @if ($product->is_featured)
                                                <span class="inline-block px-2 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-300 ml-1">Featured</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <a href="{{ route('admin.products.edit', $product) }}" class="text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 font-medium text-sm">Edit</a>
                                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline ml-3" onsubmit="return confirm('Delete {{ $product->name }}?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-700 font-medium text-sm">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-16 text-center text-gray-500 dark:text-gray-400">No products yet.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-6">{{ $products->links() }}</div>
            </div>
        </div>
    </div>
</x-app-layout>
