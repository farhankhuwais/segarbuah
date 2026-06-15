<x-app-layout title="{{ $post->title }}">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <a href="{{ route('blog.index') }}" class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400 hover:text-emerald-600 dark:hover:text-emerald-400 transition mb-6">
            <i class="ph-bold ph-arrow-left text-xs" aria-hidden="true"></i>
            Back to Blog
        </a>

        <article class="scroll-reveal">
            <div class="flex items-center gap-3 text-sm text-gray-500 dark:text-gray-400 mb-4">
                <span>{{ $post->published_at->format('d M Y') }}</span>
                <span>&middot;</span>
                <span>{{ $post->author->name }}</span>
            </div>

            <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-6">{{ $post->title }}</h1>

            @if ($post->image)
                <div class="aspect-[21/9] rounded-2xl overflow-hidden mb-8 bg-gradient-to-br from-emerald-100 via-green-50 to-emerald-50 dark:from-gray-800 dark:via-gray-800 dark:to-gray-900">
                    <img src="{{ $post->image }}" alt="{{ $post->title }}" class="w-full h-full object-cover" loading="lazy" onerror="this.remove()">
                </div>
            @endif

            @if ($post->excerpt)
                <p class="text-lg text-gray-600 dark:text-gray-400 italic mb-6">{{ $post->excerpt }}</p>
            @endif

            <div class="prose prose-gray dark:prose-invert max-w-none">
                {{ $post->content }}
            </div>
        </article>

        <div class="mt-12 pt-8 border-t border-gray-200 dark:border-gray-800 scroll-reveal">
            <h2 class="font-bold text-gray-900 dark:text-white mb-6">Recent Posts</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($recent as $r)
                    <a href="{{ route('blog.show', $r->slug) }}" class="bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-800 overflow-hidden hover:shadow-md transition group">
                        <div class="aspect-[16/9] bg-gradient-to-br from-emerald-100 via-green-50 to-emerald-50 dark:from-gray-800 dark:via-gray-800 dark:to-gray-900">
                            @if ($r->image)
                                <img src="{{ $r->image }}" alt="{{ $r->title }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-500" loading="lazy" onerror="this.remove()">
                            @else
                                <div class="w-full h-full flex items-center justify-center">
                                    <i class="ph-bold ph-leaf text-3xl text-emerald-300 dark:text-emerald-700" aria-hidden="true"></i>
                                </div>
                            @endif
                        </div>
                        <div class="p-4">
                            <p class="text-xs text-gray-500 dark:text-gray-400 mb-1">{{ $r->published_at->format('d M Y') }}</p>
                            <h3 class="font-medium text-gray-900 dark:text-white text-sm group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition">{{ $r->title }}</h3>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
