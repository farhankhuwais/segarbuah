@props(['title' => config('app.name', 'SegarBuah')])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ $title }} — SegarBuah</title>

        <script>
            if (localStorage.getItem('darkMode') === 'true' ||
                (!localStorage.getItem('darkMode') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            }
        </script>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link rel="preconnect" href="https://images.unsplash.com">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@phosphor-icons/web@2.1.1/src/bold/style.css">

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-gray-50 dark:bg-gray-950 text-gray-900 dark:text-gray-100 transition-colors">
        <nav class="sticky top-0 z-50 bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800" x-data="{ mobileOpen: false }" role="navigation" aria-label="Main navigation">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-14 items-center">
                    <a href="/" class="text-xl font-bold text-emerald-600 dark:text-emerald-400 flex items-center gap-2" aria-label="SegarBuah Home">
                        <i class="ph-duotone ph-leaf text-2xl" aria-hidden="true"></i>
                        SegarBuah
                    </a>
                    <div class="hidden sm:flex items-center gap-6">
                        <a href="/" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400 transition">Home</a>
                        <a href="{{ route('shop.index') }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400 transition">Shop</a>
                        <a href="{{ route('blog.index') }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400 transition">Blog</a>
                    </div>
                    <div class="flex items-center gap-2">
                        <button onclick="document.documentElement.classList.toggle('dark'); localStorage.setItem('darkMode', document.documentElement.classList.contains('dark'))" class="w-9 h-9 flex items-center justify-center rounded-lg text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500" aria-label="Toggle dark mode">
                            <i class="ph-bold ph-sun text-lg hidden dark:block" aria-hidden="true"></i>
                            <i class="ph-bold ph-moon text-lg block dark:hidden" aria-hidden="true"></i>
                        </button>
                        <a href="{{ route('login') }}" class="hidden sm:inline-flex text-sm font-medium text-gray-700 dark:text-gray-300 hover:text-emerald-600 dark:hover:text-emerald-400 transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500 rounded px-2">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="hidden sm:inline-flex text-sm font-semibold bg-emerald-600 text-white px-4 py-2 rounded-lg hover:bg-emerald-700 transition shadow-sm focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500">Register</a>
                        @endif
                        <button @click="mobileOpen = !mobileOpen" class="sm:hidden p-2 text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-emerald-500" aria-label="Toggle menu">
                            <i class="ph-bold ph-list text-xl" x-show="!mobileOpen" aria-hidden="true"></i>
                            <i class="ph-bold ph-x text-xl" x-show="mobileOpen" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div x-show="mobileOpen" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" class="sm:hidden border-t border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900">
                <div class="px-4 py-3 space-y-1">
                    <a href="/" class="block px-3 py-2 rounded-lg text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800">Home</a>
                    <a href="{{ route('shop.index') }}" class="block px-3 py-2 rounded-lg text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800">Shop</a>
                    <a href="{{ route('blog.index') }}" class="block px-3 py-2 rounded-lg text-sm text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800">Blog</a>
                    <hr class="border-gray-200 dark:border-gray-700 my-2">
                    <a href="{{ route('login') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-emerald-600 dark:text-emerald-400 hover:bg-gray-100 dark:hover:bg-gray-800">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="block px-3 py-2 rounded-lg text-sm font-medium text-emerald-600 dark:text-emerald-400 hover:bg-gray-100 dark:hover:bg-gray-800">Register</a>
                    @endif
                </div>
            </div>
        </nav>

        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-4 sm:pt-0 px-4">
            <div class="w-full sm:max-w-md px-6 py-8 bg-white dark:bg-gray-900 shadow-sm border border-gray-200 dark:border-gray-800 overflow-hidden sm:rounded-2xl transition-colors">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
