@php use Illuminate\Support\Str; @endphp
<nav x-data="{ open: false }" class="bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800 sticky top-0 z-50 transition-colors" role="navigation" aria-label="Main navigation">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <div class="flex items-center gap-8">
                <a href="/" class="text-xl font-bold text-emerald-600 dark:text-emerald-400 shrink-0 flex items-center gap-2" aria-label="SegarBuah Home">
                    <i class="ph-duotone ph-leaf text-2xl" aria-hidden="true"></i>
                    SegarBuah
                </a>
                <div class="hidden md:flex items-center gap-6">
                    <a href="/" class="text-sm font-medium transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500 rounded {{ request()->routeIs('home') ? 'text-emerald-600 dark:text-emerald-400' : 'text-gray-700 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400' }}">
                        Home
                    </a>
                    <a href="{{ route('shop.index') }}" class="text-sm font-medium transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500 rounded {{ request()->routeIs('shop.*') ? 'text-emerald-600 dark:text-emerald-400' : 'text-gray-700 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400' }}">
                        Shop
                    </a>
                    <a href="{{ route('blog.index') }}" class="text-sm font-medium transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500 rounded {{ request()->routeIs('blog.*') ? 'text-emerald-600 dark:text-emerald-400' : 'text-gray-700 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400' }}">
                        Blog
                    </a>
                </div>
            </div>

            <div class="flex items-center gap-1 sm:gap-2">
                <button onclick="document.documentElement.classList.toggle('dark'); localStorage.setItem('darkMode', document.documentElement.classList.contains('dark'))" class="relative w-9 h-9 flex items-center justify-center rounded-lg text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500" aria-label="Toggle dark mode" title="Toggle dark mode">
                    <i class="ph-bold ph-sun text-lg hidden dark:block" aria-hidden="true"></i>
                    <i class="ph-bold ph-moon text-lg block dark:hidden" aria-hidden="true"></i>
                </button>

                @auth
                    <a href="{{ route('wishlist.index') }}" class="relative text-gray-600 dark:text-gray-400 hover:text-emerald-600 dark:hover:text-emerald-400 transition p-2 rounded-lg focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500" aria-label="Wishlist">
                        <i class="ph-bold ph-heart text-xl" aria-hidden="true"></i>
                        @if ($wishlistCount > 0)
                            <span class="absolute -top-0.5 -right-0.5 bg-red-500 text-white text-[10px] font-bold rounded-full min-w-[18px] h-[18px] flex items-center justify-center px-1">{{ $wishlistCount }}</span>
                        @endif
                    </a>

                    <div x-data="notificationPreview" @click.away="close" class="relative">
                        <button @click="toggle" class="relative text-gray-600 dark:text-gray-400 hover:text-emerald-600 dark:hover:text-emerald-400 transition p-2 rounded-lg focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500" aria-label="Notifications">
                            <i class="ph-bold ph-bell text-xl" aria-hidden="true"></i>
                            @if ($unreadCount > 0)
                                <span class="absolute -top-0.5 -right-0.5 bg-amber-500 text-white text-[10px] font-bold rounded-full min-w-[18px] h-[18px] flex items-center justify-center px-1">{{ $unreadCount }}</span>
                            @endif
                        </button>
                        <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-1" class="absolute right-0 mt-2 w-80 bg-white dark:bg-gray-900 rounded-xl shadow-xl border border-gray-200 dark:border-gray-800 overflow-hidden" role="dialog" aria-label="Notifications">
                            @if ($recentNotifs->count())
                                <div class="max-h-72 overflow-y-auto divide-y divide-gray-100 dark:divide-gray-800">
                                    @foreach ($recentNotifs as $n)
                                        <div class="px-4 py-3 {{ $n->read_at ? '' : 'bg-emerald-50/50 dark:bg-emerald-900/10' }}">
                                            <p class="text-xs text-gray-900 dark:text-white font-medium">{{ $n->data['title'] ?? 'Notification' }}</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ Str::limit($n->data['message'] ?? '', 60) }}</p>
                                            <p class="text-[10px] text-gray-400 dark:text-gray-500 mt-0.5">{{ $n->created_at->diffForHumans() }}</p>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="px-4 py-3 border-t border-gray-200 dark:border-gray-800 bg-gray-50 dark:bg-gray-800/50 text-center">
                                    <a href="{{ route('notifications.index') }}" class="text-sm font-medium text-emerald-600 dark:text-emerald-400 hover:text-emerald-700">View all notifications</a>
                                </div>
                            @else
                                <div class="p-5 text-center">
                                    <i class="ph-bold ph-bell-slash text-3xl text-gray-300 dark:text-gray-600 mb-2" aria-hidden="true"></i>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">No notifications</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endauth

                <div x-data="cartPreview" @click.away="close" class="relative">
                    <a href="{{ route('cart.index') }}" class="relative text-gray-600 dark:text-gray-400 hover:text-emerald-600 dark:hover:text-emerald-400 transition p-2 rounded-lg focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500" aria-label="Shopping cart">
                        <i class="ph-bold ph-shopping-cart text-xl" aria-hidden="true"></i>
                        @if ($cartCount > 0)
                            <span id="cart-badge" class="absolute -top-0.5 -right-0.5 bg-emerald-500 text-white text-[10px] font-bold rounded-full min-w-[18px] h-[18px] flex items-center justify-center px-1">{{ $cartCount }}</span>
                        @else
                            <span id="cart-badge" class="absolute -top-0.5 -right-0.5 bg-emerald-500 text-white text-[10px] font-bold rounded-full min-w-[18px] h-[18px] items-center justify-center px-1" style="display:none">0</span>
                        @endif
                    </a>
                    <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-1" class="absolute right-0 mt-2 w-80 bg-white dark:bg-gray-900 rounded-xl shadow-xl border border-gray-200 dark:border-gray-800 overflow-hidden" role="dialog" aria-label="Cart preview">
                        @if (count($cartItems))
                            <div class="max-h-72 overflow-y-auto divide-y divide-gray-100 dark:divide-gray-800">
                                @foreach ($cartItems as $id => $item)
                                    <div class="flex items-center gap-3 px-4 py-3">
                                        <div class="w-10 h-10 bg-gradient-to-br from-emerald-100 via-green-50 to-emerald-50 dark:from-gray-800 dark:via-gray-800 dark:to-gray-900 rounded-lg overflow-hidden shrink-0">
                                            <img src="https://images.unsplash.com/{{ $item['image'] }}?w=60&q=50&fit=crop&auto=format" alt="{{ $item['name'] }}" class="w-full h-full object-cover" onerror="this.remove()">
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 dark:text-white truncate">{{ $item['name'] }}</p>
                                            <p class="text-xs text-gray-500 dark:text-gray-400">{{ $item['quantity'] }} x Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                                        </div>
                                        <p class="text-sm font-bold text-emerald-600 dark:text-emerald-400 shrink-0">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</p>
                                    </div>
                                @endforeach
                            </div>
                            <div class="px-4 py-3 border-t border-gray-200 dark:border-gray-800 bg-gray-50 dark:bg-gray-800/50">
                                <div class="flex justify-between items-center mb-3">
                                    <span class="text-sm font-medium text-gray-900 dark:text-white">Total</span>
                                    <span class="text-base font-bold text-emerald-600 dark:text-emerald-400">Rp {{ number_format($cartTotal, 0, ',', '.') }}</span>
                                </div>
                                <a href="{{ route('cart.index') }}" class="block w-full text-center bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-2 rounded-xl text-sm transition">
                                    View Cart
                                </a>
                            </div>
                        @else
                            <div class="p-5 text-center">
                                <i class="ph-bold ph-shopping-bag text-4xl text-gray-300 dark:text-gray-600 mb-3" aria-hidden="true"></i>
                                <p class="text-sm text-gray-500 dark:text-gray-400">Your cart is empty</p>
                                <a href="{{ route('shop.index') }}" class="mt-3 inline-flex items-center gap-1.5 text-sm font-medium text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 transition">
                                    Start Shopping
                                    <i class="ph-bold ph-arrow-right text-xs" aria-hidden="true"></i>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>

                @auth
                    <div class="hidden sm:flex sm:items-center">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="flex items-center gap-2 px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400 bg-white dark:bg-gray-900 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-800 transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500" aria-label="User menu">
                                    <i class="ph-bold ph-user-circle text-lg" aria-hidden="true"></i>
                                    <span class="hidden sm:inline">{{ Auth::user()->name }}</span>
                                    <i class="ph-bold ph-caret-down text-xs" aria-hidden="true"></i>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('orders.index')">
                                    <i class="ph-bold ph-package me-2" aria-hidden="true"></i>{{ __('My Orders') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('wishlist.index')">
                                    <i class="ph-bold ph-heart me-2" aria-hidden="true"></i>{{ __('Wishlist') }}
                                </x-dropdown-link>
                                @if (Auth::user()->is_admin)
                                    <hr class="border-gray-200 dark:border-gray-700 my-1">
                                    <p class="px-4 py-1 text-[10px] font-semibold uppercase text-gray-400 dark:text-gray-500 tracking-wider">Admin</p>
                                    <x-dropdown-link :href="route('admin.dashboard')">
                                        <i class="ph-bold ph-chart-bar me-2" aria-hidden="true"></i>{{ __('Dashboard') }}
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('admin.orders.index')">
                                        <i class="ph-bold ph-package me-2" aria-hidden="true"></i>{{ __('Manage Orders') }}
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('admin.blog.index')">
                                        <i class="ph-bold ph-file-text me-2" aria-hidden="true"></i>{{ __('Manage Blog') }}
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('admin.products.index')">
                                        <i class="ph-bold ph-apple-logo me-2" aria-hidden="true"></i>{{ __('Manage Products') }}
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('admin.categories.index')">
                                        <i class="ph-bold ph-folder me-2" aria-hidden="true"></i>{{ __('Manage Categories') }}
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('admin.flash-sale.index')">
                                        <i class="ph-bold ph-lightning me-2" aria-hidden="true"></i>{{ __('Flash Sale') }}
                                    </x-dropdown-link>
                                @endif
                                <hr class="border-gray-200 dark:border-gray-700 my-1">
                                <x-dropdown-link :href="route('profile.edit')">
                                    <i class="ph-bold ph-user me-2" aria-hidden="true"></i>{{ __('Profile') }}
                                </x-dropdown-link>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault(); this.closest('form').submit();">
                                        <i class="ph-bold ph-sign-out me-2" aria-hidden="true"></i>{{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>

                    <button @click="open = !open" class="sm:hidden p-2 text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500" aria-label="Toggle menu">
                        <i class="ph-bold ph-list text-xl" x-show="!open" aria-hidden="true"></i>
                        <i class="ph-bold ph-x text-xl" x-show="open" aria-hidden="true"></i>
                    </button>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400 transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500 rounded px-2">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-sm font-semibold bg-emerald-600 text-white px-4 py-2 rounded-lg hover:bg-emerald-700 transition shadow-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500">Register</a>
                    @endif
                @endauth
            </div>
        </div>
    </div>

    @auth
    <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="sm:hidden border-t border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900">
        <div class="px-4 py-3 space-y-1">
            <a href="/" class="block px-3 py-2 rounded-lg text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500">Home</a>
            <a href="{{ route('shop.index') }}" class="block px-3 py-2 rounded-lg text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500">Shop</a>
            <a href="{{ route('blog.index') }}" class="block px-3 py-2 rounded-lg text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500">Blog</a>
            <hr class="border-gray-200 dark:border-gray-700 my-2">
            <a href="{{ route('orders.index') }}" class="block px-3 py-2 rounded-lg text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500">
                <i class="ph-bold ph-package me-2" aria-hidden="true"></i>My Orders
            </a>
            <a href="{{ route('wishlist.index') }}" class="block px-3 py-2 rounded-lg text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500">
                <i class="ph-bold ph-heart me-2" aria-hidden="true"></i>Wishlist
            </a>
            <a href="{{ route('notifications.index') }}" class="block px-3 py-2 rounded-lg text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500">
                <i class="ph-bold ph-bell me-2" aria-hidden="true"></i>Notifications
            </a>
            @if (Auth::user()->is_admin)
                <hr class="border-gray-200 dark:border-gray-700 my-2">
                <p class="px-3 text-[10px] font-semibold uppercase text-gray-400 dark:text-gray-500 tracking-wider">Admin</p>
                <a href="{{ route('admin.dashboard') }}" class="block px-3 py-2 rounded-lg text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500">
                    <i class="ph-bold ph-chart-bar me-2" aria-hidden="true"></i>Dashboard
                </a>
                <a href="{{ route('admin.orders.index') }}" class="block px-3 py-2 rounded-lg text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500">
                    <i class="ph-bold ph-package me-2" aria-hidden="true"></i>Manage Orders
                </a>
                <a href="{{ route('admin.blog.index') }}" class="block px-3 py-2 rounded-lg text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500">
                    <i class="ph-bold ph-file-text me-2" aria-hidden="true"></i>Manage Blog
                </a>
                <a href="{{ route('admin.products.index') }}" class="block px-3 py-2 rounded-lg text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500">
                    <i class="ph-bold ph-apple-logo me-2" aria-hidden="true"></i>Manage Products
                </a>
                <a href="{{ route('admin.categories.index') }}" class="block px-3 py-2 rounded-lg text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500">
                    <i class="ph-bold ph-folder me-2" aria-hidden="true"></i>Manage Categories
                </a>
                <a href="{{ route('admin.flash-sale.index') }}" class="block px-3 py-2 rounded-lg text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500">
                    <i class="ph-bold ph-lightning me-2" aria-hidden="true"></i>Flash Sale
                </a>
            @endif
            <hr class="border-gray-200 dark:border-gray-700 my-2">
            <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded-lg text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500">
                <i class="ph-bold ph-user me-2" aria-hidden="true"></i>Profile
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full text-left px-3 py-2 rounded-lg text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500">
                    <i class="ph-bold ph-sign-out me-2" aria-hidden="true"></i>Log Out
                </button>
            </form>
        </div>
    </div>
    @endauth
</nav>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('notificationPreview', () => ({
            open: false,
            toggle() { this.open = !this.open },
            close() { this.open = false }
        }));
    });
</script>