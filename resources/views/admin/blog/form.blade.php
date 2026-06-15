<x-app-layout title="{{ isset($blogPost) ? 'Edit Post' : 'New Post' }}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="flex flex-col lg:flex-row gap-6">
            <x-admin-sidebar />
            <div class="flex-1 min-w-0">
                <a href="{{ route('admin.blog.index') }}" class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400 hover:text-emerald-600 dark:hover:text-emerald-400 transition mb-6">
                    <i class="ph-bold ph-arrow-left text-xs" aria-hidden="true"></i>
                    Back to Blog
                </a>

                <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-8 flex items-center gap-3">
                    <i class="ph-bold ph-{{ isset($blogPost) ? 'pencil' : 'plus-circle' }} text-emerald-500" aria-hidden="true"></i>
                    {{ isset($blogPost) ? 'Edit Post' : 'New Post' }}
                </h1>

                @php
                    $inputClass = 'w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:border-emerald-500 focus:ring-emerald-500 placeholder-gray-400 dark:placeholder-gray-500 px-4 py-2.5 text-sm';
                    $labelClass = 'block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5';
                    $errorClass = 'text-red-500 text-xs mt-1.5 flex items-center gap-1';
                @endphp

                <form action="{{ isset($blogPost) ? route('admin.blog.update', $blogPost) : route('admin.blog.store') }}" method="POST">
                    @csrf
                    @if (isset($blogPost)) @method('PUT') @endif

                    <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-6 transition-colors">
                        <div class="space-y-5">
                            <div>
                                <label for="title" class="{{ $labelClass }}">Title <span class="text-red-400">*</span></label>
                                <input type="text" name="title" id="title" value="{{ old('title', $blogPost->title ?? '') }}" required
                                    class="{{ $inputClass }}" placeholder="e.g. 5 Tips Memilih Sayuran Segar">
                                @error('title') <p class="{{ $errorClass }}"><i class="ph-bold ph-warning-circle"></i>{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="excerpt" class="{{ $labelClass }}">Excerpt</label>
                                <textarea name="excerpt" id="excerpt" rows="2"
                                    class="{{ $inputClass }} resize-y" placeholder="Brief summary of the post...">{{ old('excerpt', $blogPost->excerpt ?? '') }}</textarea>
                                @error('excerpt') <p class="{{ $errorClass }}"><i class="ph-bold ph-warning-circle"></i>{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="content" class="{{ $labelClass }}">Content <span class="text-red-400">*</span></label>
                                <textarea name="content" id="content" rows="10" required
                                    class="{{ $inputClass }} resize-y" placeholder="Write your article content here...">{{ old('content', $blogPost->content ?? '') }}</textarea>
                                @error('content') <p class="{{ $errorClass }}"><i class="ph-bold ph-warning-circle"></i>{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label for="image" class="{{ $labelClass }}">Image URL</label>
                                <input type="url" name="image" id="image" value="{{ old('image', $blogPost->image ?? '') }}"
                                    class="{{ $inputClass }}" placeholder="https://images.unsplash.com/photo-...">
                                @error('image') <p class="{{ $errorClass }}"><i class="ph-bold ph-warning-circle"></i>{{ $message }}</p> @enderror
                            </div>

                            <div class="flex items-center gap-2">
                                <input type="checkbox" name="is_published" id="is_published" value="1"
                                    class="rounded border-gray-300 dark:border-gray-700 text-emerald-600 focus:ring-emerald-500 shrink-0"
                                    @checked(old('is_published', $blogPost->is_published ?? false))>
                                <label for="is_published" class="text-sm text-gray-700 dark:text-gray-300">Publish immediately</label>
                            </div>
                        </div>

                        <div class="flex items-center gap-3 pt-4 border-t border-gray-200 dark:border-gray-700 mt-5">
                            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-6 py-2.5 rounded-xl text-sm transition shadow-sm">
                                {{ isset($blogPost) ? 'Update' : 'Create' }}
                            </button>
                            <a href="{{ route('admin.blog.index') }}" class="text-sm text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 transition">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
