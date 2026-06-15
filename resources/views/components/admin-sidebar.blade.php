@php
    use Illuminate\Support\Facades\Cache;

    $sidebarPendingOrders = Cache::remember('sidebar.pending_orders', 60, fn() => \App\Models\Order::where('status', 'pending')->count());
    $sidebarTotalProducts = Cache::remember('sidebar.total_products', 300, fn() => \App\Models\Product::count());
    $sidebarTotalCategories = Cache::remember('sidebar.total_categories', 300, fn() => \App\Models\Category::count());
@endphp

<aside class="lg:w-64 shrink-0">
    <nav class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 overflow-hidden transition-colors sticky top-24">
        <div class="px-4 py-4 border-b border-gray-200 dark:border-gray-800">
            <p class="text-xs font-semibold uppercase text-gray-400 dark:text-gray-500 tracking-wider">Management</p>
        </div>
        <div class="p-2 space-y-1">
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition
                      {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800' }}">
                <i class="ph-bold ph-chart-bar text-lg w-5 text-center" aria-hidden="true"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.orders.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition
                      {{ request()->routeIs('admin.orders.*') ? 'bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800' }}">
                <i class="ph-bold ph-package text-lg w-5 text-center" aria-hidden="true"></i>
                <span>Orders</span>
                <span class="ml-auto bg-gray-100 dark:bg-gray-800 text-gray-600 dark:text-gray-400 text-[10px] font-bold px-2 py-0.5 rounded-full">{{ $sidebarPendingOrders }}</span>
            </a>
            <a href="{{ route('admin.products.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition
                      {{ request()->routeIs('admin.products.*') ? 'bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800' }}">
                <i class="ph-bold ph-apple-logo text-lg w-5 text-center" aria-hidden="true"></i>
                <span>Products</span>
                <span class="ml-auto text-xs text-gray-400 dark:text-gray-500">{{ $sidebarTotalProducts }}</span>
            </a>
            <a href="{{ route('admin.categories.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition
                      {{ request()->routeIs('admin.categories.*') ? 'bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800' }}">
                <i class="ph-bold ph-folder text-lg w-5 text-center" aria-hidden="true"></i>
                <span>Categories</span>
                <span class="ml-auto text-xs text-gray-400 dark:text-gray-500">{{ $sidebarTotalCategories }}</span>
            </a>
            <a href="{{ route('admin.blog.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition
                      {{ request()->routeIs('admin.blog.*') ? 'bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800' }}">
                <i class="ph-bold ph-file-text text-lg w-5 text-center" aria-hidden="true"></i>
                <span>Blog</span>
            </a>
            <a href="{{ route('admin.flash-sale.index') }}"
               class="flex items-center gap-3 px-3 py-2.5 rounded-xl text-sm font-medium transition
                      {{ request()->routeIs('admin.flash-sale.*') ? 'bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400' : 'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-800' }}">
                <i class="ph-bold ph-lightning text-lg w-5 text-center" aria-hidden="true"></i>
                <span>Flash Sale</span>
            </a>
        </div>
        <div class="px-4 py-3 border-t border-gray-200 dark:border-gray-800">
            <a href="{{ route('shop.index') }}"
               class="flex items-center gap-2 px-3 py-2 rounded-xl text-sm text-gray-500 dark:text-gray-400 hover:bg-gray-50 dark:hover:bg-gray-800 transition">
                <i class="ph-bold ph-storefront text-base" aria-hidden="true"></i>
                <span>View Store</span>
                <i class="ph-bold ph-arrow-up-right ml-auto text-xs" aria-hidden="true"></i>
            </a>
        </div>
    </nav>
</aside>
