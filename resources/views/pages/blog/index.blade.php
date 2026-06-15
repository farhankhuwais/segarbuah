<x-app-layout title="Blog">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="text-center mb-12 scroll-reveal">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-3">SegarBuah Blog</h1>
            <p class="text-gray-500 dark:text-gray-400 max-w-lg mx-auto">Tips, recipes, and stories about fresh fruits & vegetables.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse ($posts as $post)
                <article class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 overflow-hidden hover:shadow-lg transition group scroll-reveal">
                    <a href="{{ route('blog.show', $post->slug) }}">
                        <div class="aspect-[16/9] bg-gradient-to-br from-emerald-100 via-green-50 to-emerald-50 dark:from-gray-800 dark:via-gray-800 dark:to-gray-900 overflow-hidden">
                            @if ($post->image)
                                <img src="{{ $post->image }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" loading="lazy" onerror="this.remove()">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <i class="ph-bold ph-leaf text-5xl text-emerald-300 dark:text-emerald-700" aria-hidden="true"></i>
                                </div>
                            @endif
                        </div>
                    </a>
                    <div class="p-5">
                        <div class="flex items-center gap-3 text-xs text-gray-500 dark:text-gray-400 mb-2">
                            <span>{{ $post->published_at->format('d M Y') }}</span>
                            <span>&middot;</span>
                            <span>{{ $post->author->name }}</span>
                        </div>
                        <a href="{{ route('blog.show', $post->slug) }}">
                            <h2 class="font-bold text-gray-900 dark:text-white group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition mb-2">{{ $post->title }}</h2>
                        </a>
                        @if ($post->excerpt)
                            <p class="text-sm text-gray-500 dark:text-gray-400 line-clamp-2">{{ $post->excerpt }}</p>
                        @endif
                        <a href="{{ route('blog.show', $post->slug) }}" class="inline-flex items-center gap-1 text-sm font-medium text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 mt-3 transition">
                            Read more
                            <i class="ph-bold ph-arrow-right text-xs" aria-hidden="true"></i>
                        </a>
                    </div>
                </article>
            @empty
                <div class="col-span-full text-center py-16">
                    <i class="ph-bold ph-file-text text-6xl text-gray-300 dark:text-gray-600 mb-4" aria-hidden="true"></i>
                    <p class="text-gray-500 dark:text-gray-400">No blog posts yet. Stay tuned!</p>
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $posts->links() }}
        </div>
    </div>
</x-app-layout>
