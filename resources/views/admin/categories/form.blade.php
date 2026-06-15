<x-app-layout title="{{ isset($category) ? 'Edit Category' : 'New Category' }}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="flex flex-col lg:flex-row gap-6">
            <x-admin-sidebar />
            <div class="flex-1 min-w-0">
                <a href="{{ route('admin.categories.index') }}" class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400 hover:text-emerald-600 dark:hover:text-emerald-400 transition mb-6">
                    <i class="ph-bold ph-arrow-left text-xs" aria-hidden="true"></i>
                    Back to Categories
                </a>

                <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-8 flex items-center gap-3">
                    <i class="ph-bold ph-{{ isset($category) ? 'pencil' : 'plus-circle' }} text-emerald-500" aria-hidden="true"></i>
                    {{ isset($category) ? 'Edit Category' : 'New Category' }}
                </h1>

        @php
            $inputClass = 'w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:border-emerald-500 focus:ring-emerald-500 placeholder-gray-400 dark:placeholder-gray-500 px-4 py-2.5 text-sm';
            $labelClass = 'block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5';
            $errorClass = 'text-red-500 text-xs mt-1.5 flex items-center gap-1';
        @endphp

        <form action="{{ isset($category) ? route('admin.categories.update', $category) : route('admin.categories.store') }}" method="POST">
            @csrf
            @if (isset($category)) @method('PUT') @endif

            <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-6 transition-colors">
                <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100 dark:border-gray-800">
                    <div class="w-9 h-9 rounded-xl bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center shrink-0">
                        <i class="ph-bold ph-folder text-emerald-600 dark:text-emerald-400" aria-hidden="true"></i>
                    </div>
                    <div>
                        <h2 class="font-semibold text-gray-900 dark:text-white">{{ isset($category) ? 'Edit Category' : 'New Category' }}</h2>
                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ isset($category) ? 'Update category details' : 'Create a new product category' }}</p>
                    </div>
                </div>

                <div class="space-y-5">
                    <div>
                        <label for="name" class="{{ $labelClass }}">Category Name <span class="text-red-400">*</span></label>
                        <input type="text" name="name" id="name" value="{{ old('name', $category->name ?? '') }}" required
                            class="{{ $inputClass }}" placeholder="e.g. Leafy Vegetables">
                        @error('name') <p class="{{ $errorClass }}"><i class="ph-bold ph-warning-circle"></i>{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="description" class="{{ $labelClass }}">Description</label>
                        <textarea name="description" id="description" rows="3"
                            class="{{ $inputClass }} resize-y" placeholder="Brief description of this category...">{{ old('description', $category->description ?? '') }}</textarea>
                        @error('description') <p class="{{ $errorClass }}"><i class="ph-bold ph-warning-circle"></i>{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="image" class="{{ $labelClass }}">Image URL</label>
                        <input type="url" name="image" id="image" value="{{ old('image', $category->image ?? '') }}"
                            class="{{ $inputClass }}" placeholder="https://images.unsplash.com/photo-...">
                        @error('image') <p class="{{ $errorClass }}"><i class="ph-bold ph-warning-circle"></i>{{ $message }}</p> @enderror
                    </div>

                    <label class="flex items-center gap-3 p-4 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50 cursor-pointer hover:border-emerald-300 dark:hover:border-emerald-700 transition has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50 dark:has-[:checked]:bg-emerald-900/20">
                        <input type="checkbox" name="is_active" id="is_active" value="1"
                            class="rounded border-gray-300 dark:border-gray-700 text-emerald-600 focus:ring-emerald-500 shrink-0"
                            @checked(old('is_active', $category->is_active ?? true))>
                        <div>
                            <span class="block text-sm font-medium text-gray-700 dark:text-gray-300">Active</span>
                            <span class="text-[10px] text-gray-400 dark:text-gray-500">Show this category on the website</span>
                        </div>
                    </label>

                    <div class="flex items-center justify-between gap-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                        <p class="text-xs text-gray-400 dark:text-gray-500">
                            <i class="ph-bold ph-info me-1"></i>
                            Slug will be auto-generated from the name
                        </p>
                        <div class="flex items-center gap-3">
                            <a href="{{ route('admin.categories.index') }}" class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 transition px-4 py-2">Cancel</a>
                            <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-6 py-2.5 rounded-xl text-sm transition shadow-sm inline-flex items-center gap-2">
                                <i class="ph-bold ph-{{ isset($category) ? 'floppy-disk' : 'plus-circle' }}" aria-hidden="true"></i>
                                {{ isset($category) ? 'Update Category' : 'Create Category' }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
            </div>
        </div>
    </div>
</x-app-layout>
