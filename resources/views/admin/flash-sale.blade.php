@php use Illuminate\Support\Str; @endphp
<x-app-layout title="Flash Sale Management">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="flex flex-col lg:flex-row gap-6">
            <x-admin-sidebar />
            <div class="flex-1 min-w-0">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-8 flex items-center gap-3">
                    <i class="ph-bold ph-lightning text-emerald-500" aria-hidden="true"></i>
                    Flash Sale Management
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
                            <th class="text-left px-6 py-3 font-semibold text-gray-900 dark:text-white">Product</th>
                            <th class="text-left px-6 py-3 font-semibold text-gray-900 dark:text-white">Price</th>
                            <th class="text-left px-6 py-3 font-semibold text-gray-900 dark:text-white">Sale Price</th>
                            <th class="text-left px-6 py-3 font-semibold text-gray-900 dark:text-white">Starts</th>
                            <th class="text-left px-6 py-3 font-semibold text-gray-900 dark:text-white">Ends</th>
                            <th class="text-left px-6 py-3 font-semibold text-gray-900 dark:text-white">Status</th>
                            <th class="text-right px-6 py-3 font-semibold text-gray-900 dark:text-white">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @forelse ($products as $product)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-800/30 transition">
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $product->name }}</td>
                                <td class="px-6 py-4 text-gray-600 dark:text-gray-400">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                                <td class="px-6 py-4">
                                    @if ($product->activeSale()->exists())
                                        <span class="text-emerald-600 dark:text-emerald-400 font-semibold">Rp {{ number_format($product->sale_price, 0, ',', '.') }}</span>
                                    @elseif ($product->sale_price)
                                        <span class="text-gray-400 dark:text-gray-500">Rp {{ number_format($product->sale_price, 0, ',', '.') }}</span>
                                    @else
                                        <span class="text-gray-400 dark:text-gray-500">—</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-xs text-gray-500 dark:text-gray-400 whitespace-nowrap">{{ $product->sale_starts_at ? $product->sale_starts_at->format('d M Y H:i') : '—' }}</td>
                                <td class="px-6 py-4 text-xs text-gray-500 dark:text-gray-400 whitespace-nowrap">{{ $product->sale_ends_at ? $product->sale_ends_at->format('d M Y H:i') : '—' }}</td>
                                <td class="px-6 py-4">
                                    @if ($product->activeSale()->exists())
                                        <span class="inline-block px-2 py-0.5 rounded-full text-xs font-semibold bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-300">ACTIVE</span>
                                    @elseif ($product->sale_price && $product->sale_starts_at && $product->sale_starts_at > now())
                                        <span class="inline-block px-2 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-300">Scheduled</span>
                                    @elseif ($product->sale_price && $product->sale_ends_at && $product->sale_ends_at < now())
                                        <span class="inline-block px-2 py-0.5 rounded-full text-xs font-semibold bg-gray-100 text-gray-700 dark:bg-gray-800 dark:text-gray-300">Expired</span>
                                    @else
                                        <span class="text-gray-400 dark:text-gray-500 text-xs">—</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button @click="$dispatch('open-flash-sale', { id: {{ $product->id }}, name: '{{ $product->name }}', price: {{ $product->price }}, sale_price: '{{ $product->sale_price ?? '' }}', starts_at: '{{ $product->sale_starts_at ? $product->sale_starts_at->format('Y-m-d\TH:i') : '' }}', ends_at: '{{ $product->sale_ends_at ? $product->sale_ends_at->format('Y-m-d\TH:i') : '' }}' })"
                                            class="text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 font-medium text-sm inline-flex items-center gap-1">
                                        {{ $product->sale_price ? 'Edit' : 'Set Sale' }}
                                        <i class="ph-bold ph-pencil text-xs" aria-hidden="true"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="px-6 py-16 text-center text-gray-500 dark:text-gray-400">No products.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-6">{{ $products->links() }}</div>
            </div>
        </div>
    </div>

    <div x-data="flashSaleModal" x-show="open" x-cloak class="fixed inset-0 z-[60] flex items-center justify-center p-4" role="dialog" aria-modal="true" aria-label="Flash sale form">
        <div class="fixed inset-0 bg-black/50" @click="open = false"></div>
        <div class="relative bg-white dark:bg-gray-900 rounded-2xl shadow-xl max-w-lg w-full p-6 border border-gray-200 dark:border-gray-800">
            <h3 class="font-bold text-gray-900 dark:text-white mb-4" x-text="editingName ? `Flash Sale: ${editingName}` : 'Flash Sale'"></h3>
            <form :action="`/admin/flash-sale/${editingId}`" method="POST">
                @csrf
                @method('PATCH')
                <div class="space-y-4">
                    <p class="text-sm text-gray-500 dark:text-gray-400">Original price: <strong x-text="`Rp ${editingPrice.toLocaleString('id-ID')}`" class="text-gray-900 dark:text-white"></strong></p>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Sale Price</label>
                        <input type="number" step="0.01" name="sale_price" x-model="salePrice" class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:border-emerald-500 focus:ring-emerald-500 px-4 py-2.5 text-sm placeholder-gray-400 dark:placeholder-gray-500" placeholder="Leave empty to remove sale">
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Starts At</label>
                            <input type="datetime-local" name="sale_starts_at" x-model="startsAt" class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:border-emerald-500 focus:ring-emerald-500 px-4 py-2.5 text-sm">
                         </div>
                         <div>
                             <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Ends At</label>
                             <input type="datetime-local" name="sale_ends_at" x-model="endsAt" class="w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:border-emerald-500 focus:ring-emerald-500 px-4 py-2.5 text-sm">
                        </div>
                    </div>
                </div>
                <div class="flex items-center gap-3 mt-6 pt-4 border-t border-gray-200 dark:border-gray-700">
                    <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-6 py-2.5 rounded-xl text-sm transition shadow-sm">Save</button>
                    <button type="button" @click="open = false" class="text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 transition">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('flashSaleModal', () => ({
                open: false,
                editingId: null,
                editingName: '',
                editingPrice: 0,
                salePrice: '',
                startsAt: '',
                endsAt: '',
                init() {
                    this.$el.addEventListener('open-flash-sale', (e) => {
                        const d = e.detail;
                        this.editingId = d.id;
                        this.editingName = d.name;
                        this.editingPrice = d.price;
                        this.salePrice = d.sale_price || '';
                        this.startsAt = d.starts_at || '';
                        this.endsAt = d.ends_at || '';
                        this.open = true;
                    });
                }
            }));
        });
    </script>
</x-app-layout>
