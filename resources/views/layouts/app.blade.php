<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $title ?? config('app.name', 'SegarBuah') }} — SegarBuah</title>

        <script>
            if (localStorage.getItem('darkMode') === 'true' ||
                (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            }
        </script>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link rel="preconnect" href="https://images.unsplash.com">
        <link rel="preconnect" href="https://upload.wikimedia.org">
        <link rel="dns-prefetch" href="https://images.unsplash.com">
        <link rel="dns-prefetch" href="https://upload.wikimedia.org">

        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/bold/style.css">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-white dark:bg-gray-950 text-gray-900 dark:text-gray-100 transition-colors">
        <div id="loading-bar" role="status" aria-label="Loading"></div>
        <div class="min-h-screen flex flex-col">
            @include('layouts.navigation')

            @isset($header)
                <header class="bg-white dark:bg-gray-900 shadow-sm border-b border-gray-200 dark:border-gray-800">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="flex-1">
                {{ $slot }}
            </main>

            <footer class="bg-gray-900 dark:bg-gray-950 text-gray-300 border-t border-gray-800">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-8">
                        <div class="lg:col-span-2">
                            <h3 class="text-xl font-bold text-white mb-4">
                                <i class="ph-duotone ph-leaf text-emerald-400 me-2"></i>SegarBuah
                            </h3>
                            <p class="text-gray-400 text-sm leading-relaxed mb-4">
                                Toko sayur dan buah segar online. Kami menghadirkan produk-produk berkualitas langsung dari petani ke meja Anda. Fresh, sehat, dan terpercaya.
                            </p>
                            <div class="flex items-center gap-3">
                                <a href="#" class="w-9 h-9 bg-gray-800 hover:bg-emerald-600 rounded-lg flex items-center justify-center transition">
                                    <i class="ph-bold ph-instagram-logo text-white text-lg"></i>
                                </a>
                                <a href="#" class="w-9 h-9 bg-gray-800 hover:bg-emerald-600 rounded-lg flex items-center justify-center transition">
                                    <i class="ph-bold ph-facebook-logo text-white text-lg"></i>
                                </a>
                                <a href="#" class="w-9 h-9 bg-gray-800 hover:bg-emerald-600 rounded-lg flex items-center justify-center transition">
                                    <i class="ph-bold ph-twitter-logo text-white text-lg"></i>
                                </a>
                                <a href="#" class="w-9 h-9 bg-gray-800 hover:bg-emerald-600 rounded-lg flex items-center justify-center transition">
                                    <i class="ph-bold ph-whatsapp-logo text-white text-lg"></i>
                                </a>
                            </div>
                        </div>

                        <div>
                            <h4 class="font-semibold text-white mb-4">Quick Links</h4>
                            <ul class="space-y-2.5 text-sm">
                                <li><a href="/" class="text-gray-400 hover:text-emerald-400 transition flex items-center gap-2"><i class="ph-bold ph-caret-right text-emerald-500 text-xs"></i>Home</a></li>
                                <li><a href="{{ route('shop.index') }}" class="text-gray-400 hover:text-emerald-400 transition flex items-center gap-2"><i class="ph-bold ph-caret-right text-emerald-500 text-xs"></i>Shop</a></li>
                                <li><a href="#" class="text-gray-400 hover:text-emerald-400 transition flex items-center gap-2"><i class="ph-bold ph-caret-right text-emerald-500 text-xs"></i>About Us</a></li>
                                <li><a href="#" class="text-gray-400 hover:text-emerald-400 transition flex items-center gap-2"><i class="ph-bold ph-caret-right text-emerald-500 text-xs"></i>Contact</a></li>
                            </ul>
                        </div>

                        <div>
                            <h4 class="font-semibold text-white mb-4">Customer Service</h4>
                            <ul class="space-y-2.5 text-sm">
                                <li><a href="#" class="text-gray-400 hover:text-emerald-400 transition flex items-center gap-2"><i class="ph-bold ph-caret-right text-emerald-500 text-xs"></i>FAQ</a></li>
                                <li><a href="#" class="text-gray-400 hover:text-emerald-400 transition flex items-center gap-2"><i class="ph-bold ph-caret-right text-emerald-500 text-xs"></i>Shipping Info</a></li>
                                <li><a href="#" class="text-gray-400 hover:text-emerald-400 transition flex items-center gap-2"><i class="ph-bold ph-caret-right text-emerald-500 text-xs"></i>Returns Policy</a></li>
                                <li><a href="#" class="text-gray-400 hover:text-emerald-400 transition flex items-center gap-2"><i class="ph-bold ph-caret-right text-emerald-500 text-xs"></i>Privacy Policy</a></li>
                            </ul>
                        </div>

                        <div>
                            <h4 class="font-semibold text-white mb-4">Contact</h4>
                            <ul class="space-y-3 text-sm">
                                <li class="flex items-start gap-2">
                                    <i class="ph-bold ph-map-pin text-emerald-400 mt-0.5"></i>
                                    <span class="text-gray-400">Jl. Merdeka No. 123, Jakarta Pusat</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <i class="ph-bold ph-phone text-emerald-400"></i>
                                    <span class="text-gray-400">+62 123 4567 890</span>
                                </li>
                                <li class="flex items-center gap-2">
                                    <i class="ph-bold ph-envelope text-emerald-400"></i>
                                    <span class="text-gray-400">hello@segarbuah.com</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <i class="ph-bold ph-clock text-emerald-400 mt-0.5"></i>
                                    <span class="text-gray-400">Mon - Sat: 07:00 - 21:00<br>Sunday: 08:00 - 18:00</span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="border-t border-gray-800 mt-10 pt-8 flex flex-col sm:flex-row items-center justify-between gap-4">
                        <p class="text-sm text-gray-500">
                            &copy; {{ date('Y') }} SegarBuah. All rights reserved.
                        </p>
                        <div class="flex items-center gap-3">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/5/5e/Visa_Inc._logo.svg" alt="Visa" class="h-6 opacity-50">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/MasterCard_Logo.svg" alt="Mastercard" class="h-6 opacity-50">
                            <span class="text-xs text-gray-600">|</span>
                            <i class="ph-fill ph-shield-check text-emerald-400 text-lg"></i>
                            <span class="text-xs text-gray-500">Secure Payment</span>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

        <button id="scroll-top" aria-label="Scroll to top" class="w-10 h-10 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl shadow-lg flex items-center justify-center transition cursor-pointer">
            <i class="ph-bold ph-arrow-up text-lg"></i>
        </button>

        {{-- Global Quick View Modal --}}
        <div x-data="quickView" @open-quick-view.window="show($event.detail)" @keydown.escape.window="close()">
            <div x-show="open" x-cloak class="modal-overlay open" @click="close()" aria-hidden="true"></div>
            <div x-show="open" x-cloak class="modal-content open" role="dialog" aria-modal="true" aria-label="Quick view">
                <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95 translate-y-4" x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100 translate-y-0" x-transition:leave-end="opacity-0 scale-95 translate-y-4" class="modal-panel">
                    <template x-if="product">
                        <div>
                            <div class="relative bg-gradient-to-br from-emerald-100 via-green-50 to-emerald-50 dark:from-gray-800 dark:via-gray-800 dark:to-gray-900 rounded-t-2xl overflow-hidden">
                                <img :src="`https://images.unsplash.com/${product.img}?w=400&q=50&fit=crop&auto=format`"
                                     :alt="product.name"
                                     class="w-full h-56 sm:h-64 object-cover"
                                     onerror="this.remove()">
                                <div class="absolute top-3 left-3 flex flex-col gap-1.5">
                                    <template x-if="product.organic">
                                        <span class="bg-emerald-500 text-white text-xs font-bold px-2.5 py-1 rounded-full shadow-sm">ORGANIC</span>
                                    </template>
                                    <template x-if="product.seasonal">
                                        <span class="bg-amber-500 text-white text-xs font-bold px-2.5 py-1 rounded-full shadow-sm">SEASONAL</span>
                                    </template>
                                    <template x-if="product.discount > 0">
                                        <span class="bg-red-500 text-white text-xs font-bold px-2.5 py-1 rounded-full shadow-sm" x-text="`-${product.discount}%`"></span>
                                    </template>
                                </div>
                                <button @click="close()" class="absolute top-3 right-3 w-8 h-8 bg-white/90 dark:bg-gray-800/90 rounded-full flex items-center justify-center text-gray-600 dark:text-gray-300 hover:text-red-500 transition shadow-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500" aria-label="Close">
                                    <i class="ph-bold ph-x text-sm" aria-hidden="true"></i>
                                </button>
                            </div>
                            <div class="p-5">
                                <p class="text-xs text-emerald-600 dark:text-emerald-400 font-semibold uppercase tracking-wider mb-1" x-text="product.category"></p>
                                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-2" x-text="product.name"></h2>
                                <p class="text-sm text-gray-500 dark:text-gray-400 flex items-center gap-1 mb-4">
                                    <i class="ph-bold ph-map-pin text-emerald-500" aria-hidden="true"></i>
                                    <span x-text="product.origin"></span>
                                </p>
                                <div class="flex items-baseline gap-2 mb-5">
                                    <span class="text-2xl font-bold text-emerald-600 dark:text-emerald-400" x-text="`Rp ${Number(product.price).toLocaleString('id-ID')}`"></span>
                                    <span class="text-sm text-gray-400 dark:text-gray-500" x-text="`/ ${product.unit}`"></span>
                                </div>
                                <div class="flex items-center gap-3">
                                    <div class="flex items-center border border-gray-300 dark:border-gray-600 rounded-xl overflow-hidden">
                                        <button @click="dec()" class="w-9 h-9 flex items-center justify-center text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition focus-visible:outline-none" aria-label="Decrease quantity">
                                            <i class="ph-bold ph-minus text-sm" aria-hidden="true"></i>
                                        </button>
                                        <span class="w-10 h-9 flex items-center justify-center text-sm font-semibold text-gray-900 dark:text-white border-x border-gray-300 dark:border-gray-600" x-text="qty"></span>
                                        <button @click="inc()" class="w-9 h-9 flex items-center justify-center text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition focus-visible:outline-none" aria-label="Increase quantity">
                                            <i class="ph-bold ph-plus text-sm" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                    <button @click="addToCartFromQuick(product.id, qty)" :disabled="adding"
                                            class="flex-1 font-semibold px-5 py-2.5 rounded-xl transition shadow-sm text-center text-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500"
                                            :class="added ? 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400' : 'bg-emerald-600 hover:bg-emerald-700 text-white'">
                                        <template x-if="!added">
                                            <span>
                                                <i class="ph-bold ph-shopping-cart me-1.5" :class="{ 'animate-spin': adding }" aria-hidden="true"></i>
                                                <span x-text="adding ? 'Adding...' : 'Add to Cart'"></span>
                                            </span>
                                        </template>
                                        <template x-if="added">
                                            <span><i class="ph-bold ph-check me-1" aria-hidden="true"></i>Added!</span>
                                        </template>
                                    </button>
                                </div>
                                <a :href="`/product/${product.slug}`" class="mt-3 block text-center text-sm text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 font-medium transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500 rounded">
                                    View Full Details
                                    <i class="ph-bold ph-arrow-right text-xs ms-1" aria-hidden="true"></i>
                                </a>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </body>
</html>
