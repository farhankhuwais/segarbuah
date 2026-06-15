<x-app-layout title="{{ isset($product) ? 'Edit Product' : 'New Product' }}">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
        <div class="flex flex-col lg:flex-row gap-6">
            <x-admin-sidebar />
            <div class="flex-1 min-w-0">
                <a href="{{ route('admin.products.index') }}" class="inline-flex items-center gap-1.5 text-sm text-gray-500 dark:text-gray-400 hover:text-emerald-600 dark:hover:text-emerald-400 transition mb-6">
                    <i class="ph-bold ph-arrow-left text-xs" aria-hidden="true"></i>
                    Back to Products
                </a>

                <h1 class="text-2xl font-bold text-gray-900 dark:text-white mb-8 flex items-center gap-3">
                    <i class="ph-bold ph-{{ isset($product) ? 'pencil' : 'plus-circle' }} text-emerald-500" aria-hidden="true"></i>
                    {{ isset($product) ? 'Edit Product' : 'New Product' }}
                </h1>

        @php
            $inputClass = 'w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:border-emerald-500 focus:ring-emerald-500 placeholder-gray-400 dark:placeholder-gray-500 px-4 py-2.5 text-sm';
            $selectClass = 'w-full rounded-xl border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:border-emerald-500 focus:ring-emerald-500 px-4 py-2.5 text-sm';
            $errorClass = 'text-red-500 text-xs mt-1.5 flex items-center gap-1';
            $labelClass = 'block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1.5';
        @endphp

        <form action="{{ isset($product) ? route('admin.products.update', $product) : route('admin.products.store') }}" method="POST">
            @csrf
            @if (isset($product)) @method('PUT') @endif

            <div class="space-y-8">

                {{-- Basic Information --}}
                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-6 transition-colors">
                    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100 dark:border-gray-800">
                        <div class="w-9 h-9 rounded-xl bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center shrink-0">
                            <i class="ph-bold ph-info text-emerald-600 dark:text-emerald-400" aria-hidden="true"></i>
                        </div>
                        <div>
                            <h2 class="font-semibold text-gray-900 dark:text-white">Basic Information</h2>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Product name, category, and pricing</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="name" class="{{ $labelClass }}">Product Name <span class="text-red-400">*</span></label>
                            <input type="text" name="name" id="name" value="{{ old('name', $product->name ?? '') }}" required
                                class="{{ $inputClass }}" placeholder="e.g. Fresh Spinach">
                            @error('name') <p class="{{ $errorClass }}"><i class="ph-bold ph-warning-circle"></i>{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="sku" class="{{ $labelClass }}">SKU <span class="text-red-400">*</span></label>
                            <input type="text" name="sku" id="sku" value="{{ old('sku', $product->sku ?? '') }}" required
                                class="{{ $inputClass }}" placeholder="e.g. VEG-SPN-001">
                            @error('sku') <p class="{{ $errorClass }}"><i class="ph-bold ph-warning-circle"></i>{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="category_id" class="{{ $labelClass }}">Category <span class="text-red-400">*</span></label>
                            <select name="category_id" id="category_id" required class="{{ $selectClass }}">
                                <option value="" class="text-gray-400">— Select Category —</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id ?? '') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id') <p class="{{ $errorClass }}"><i class="ph-bold ph-warning-circle"></i>{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="unit" class="{{ $labelClass }}">Unit <span class="text-red-400">*</span></label>
                            <select name="unit" id="unit" required class="{{ $selectClass }}">
                                @foreach (['kg', 'gram', 'ikat', 'buah', 'pack', 'liter', 'sachet'] as $u)
                                    <option value="{{ $u }}" {{ old('unit', $product->unit ?? '') == $u ? 'selected' : '' }}>{{ $u }}</option>
                                @endforeach
                            </select>
                            @error('unit') <p class="{{ $errorClass }}"><i class="ph-bold ph-warning-circle"></i>{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="price" class="{{ $labelClass }}">Price <span class="text-red-400">*</span></label>
                            <input type="number" name="price" id="price" value="{{ old('price', $product->price ?? '') }}" required min="0"
                                class="{{ $inputClass }}" placeholder="Rp 0">
                            @error('price') <p class="{{ $errorClass }}"><i class="ph-bold ph-warning-circle"></i>{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="compare_price" class="{{ $labelClass }}">Compare Price</label>
                            <input type="number" name="compare_price" id="compare_price" value="{{ old('compare_price', $product->compare_price ?? '') }}" min="0"
                                class="{{ $inputClass }}" placeholder="Rp 0">
                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Original price for showing discount</p>
                            @error('compare_price') <p class="{{ $errorClass }}"><i class="ph-bold ph-warning-circle"></i>{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                {{-- Inventory --}}
                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-6 transition-colors">
                    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100 dark:border-gray-800">
                        <div class="w-9 h-9 rounded-xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center shrink-0">
                            <i class="ph-bold ph-package text-blue-600 dark:text-blue-400" aria-hidden="true"></i>
                        </div>
                        <div>
                            <h2 class="font-semibold text-gray-900 dark:text-white">Inventory & Shipping</h2>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Stock, weight, and origin details</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label for="stock" class="{{ $labelClass }}">Stock Quantity <span class="text-red-400">*</span></label>
                            <input type="number" name="stock" id="stock" value="{{ old('stock', $product->stock ?? '') }}" required min="0"
                                class="{{ $inputClass }}" placeholder="0">
                            @error('stock') <p class="{{ $errorClass }}"><i class="ph-bold ph-warning-circle"></i>{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="min_order" class="{{ $labelClass }}">Min. Order</label>
                            <input type="number" name="min_order" id="min_order" value="{{ old('min_order', $product->min_order ?? '1') }}" min="0" step="0.01"
                                class="{{ $inputClass }}" placeholder="1">
                            @error('min_order') <p class="{{ $errorClass }}"><i class="ph-bold ph-warning-circle"></i>{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="weight_in_grams" class="{{ $labelClass }}">Weight (grams)</label>
                            <div class="relative">
                                <input type="number" name="weight_in_grams" id="weight_in_grams" value="{{ old('weight_in_grams', $product->weight_in_grams ?? '') }}" min="0" step="0.01"
                                    class="{{ $inputClass }} pr-8" placeholder="0">
                                <span class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-400 dark:text-gray-500 text-xs pointer-events-none">g</span>
                            </div>
                            @error('weight_in_grams') <p class="{{ $errorClass }}"><i class="ph-bold ph-warning-circle"></i>{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="origin" class="{{ $labelClass }}">Origin</label>
                            <input type="text" name="origin" id="origin" value="{{ old('origin', $product->origin ?? '') }}"
                                class="{{ $inputClass }}" placeholder="e.g. Malang, East Java">
                            @error('origin') <p class="{{ $errorClass }}"><i class="ph-bold ph-warning-circle"></i>{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                {{-- Media & Description --}}
                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-6 transition-colors">
                    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100 dark:border-gray-800">
                        <div class="w-9 h-9 rounded-xl bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center shrink-0">
                            <i class="ph-bold ph-image text-purple-600 dark:text-purple-400" aria-hidden="true"></i>
                        </div>
                        <div>
                            <h2 class="font-semibold text-gray-900 dark:text-white">Media & Description</h2>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Product images and details</p>
                        </div>
                    </div>
                    <div class="space-y-5">
                        <div>
                            <label for="image" class="{{ $labelClass }}">Image URL</label>
                            <input type="url" name="image" id="image" value="{{ old('image', $product->image ?? '') }}"
                                class="{{ $inputClass }}" placeholder="https://images.unsplash.com/photo-...">
                            @error('image') <p class="{{ $errorClass }}"><i class="ph-bold ph-warning-circle"></i>{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="description" class="{{ $labelClass }}">Description</label>
                            <textarea name="description" id="description" rows="4"
                                class="{{ $inputClass }} resize-y" placeholder="Describe your product...">{{ old('description', $product->description ?? '') }}</textarea>
                            @error('description') <p class="{{ $errorClass }}"><i class="ph-bold ph-warning-circle"></i>{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label for="storage_info" class="{{ $labelClass }}">Storage Information</label>
                            <textarea name="storage_info" id="storage_info" rows="2"
                                class="{{ $inputClass }} resize-y" placeholder="e.g. Keep refrigerated at 2-4°C">{{ old('storage_info', $product->storage_info ?? '') }}</textarea>
                            @error('storage_info') <p class="{{ $errorClass }}"><i class="ph-bold ph-warning-circle"></i>{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                {{-- Flags --}}
                <div class="bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-6 transition-colors">
                    <div class="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100 dark:border-gray-800">
                        <div class="w-9 h-9 rounded-xl bg-amber-100 dark:bg-amber-900/30 flex items-center justify-center shrink-0">
                            <i class="ph-bold ph-tag text-amber-600 dark:text-amber-400" aria-hidden="true"></i>
                        </div>
                        <div>
                            <h2 class="font-semibold text-gray-900 dark:text-white">Product Flags</h2>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Organic, seasonal, featured, and status</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <label class="flex items-center gap-3 p-4 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50 cursor-pointer hover:border-emerald-300 dark:hover:border-emerald-700 transition has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50 dark:has-[:checked]:bg-emerald-900/20">
                            <input type="checkbox" name="is_organic" id="is_organic" value="1"
                                class="rounded border-gray-300 dark:border-gray-700 text-emerald-600 focus:ring-emerald-500 shrink-0"
                                @checked(old('is_organic', $product->is_organic ?? false))>
                            <div>
                                <span class="block text-sm font-medium text-gray-700 dark:text-gray-300">Organic</span>
                                <span class="text-[10px] text-gray-400 dark:text-gray-500">Certified organic</span>
                            </div>
                        </label>
                        <label class="flex items-center gap-3 p-4 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50 cursor-pointer hover:border-emerald-300 dark:hover:border-emerald-700 transition has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50 dark:has-[:checked]:bg-emerald-900/20">
                            <input type="checkbox" name="is_seasonal" id="is_seasonal" value="1"
                                class="rounded border-gray-300 dark:border-gray-700 text-emerald-600 focus:ring-emerald-500 shrink-0"
                                @checked(old('is_seasonal', $product->is_seasonal ?? false))>
                            <div>
                                <span class="block text-sm font-medium text-gray-700 dark:text-gray-300">Seasonal</span>
                                <span class="text-[10px] text-gray-400 dark:text-gray-500">Seasonal produce</span>
                            </div>
                        </label>
                        <label class="flex items-center gap-3 p-4 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50 cursor-pointer hover:border-emerald-300 dark:hover:border-emerald-700 transition has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50 dark:has-[:checked]:bg-emerald-900/20">
                            <input type="checkbox" name="is_featured" id="is_featured" value="1"
                                class="rounded border-gray-300 dark:border-gray-700 text-emerald-600 focus:ring-emerald-500 shrink-0"
                                @checked(old('is_featured', $product->is_featured ?? false))>
                            <div>
                                <span class="block text-sm font-medium text-gray-700 dark:text-gray-300">Featured</span>
                                <span class="text-[10px] text-gray-400 dark:text-gray-500">Show on homepage</span>
                            </div>
                        </label>
                        <label class="flex items-center gap-3 p-4 rounded-xl border border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-800/50 cursor-pointer hover:border-emerald-300 dark:hover:border-emerald-700 transition has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50 dark:has-[:checked]:bg-emerald-900/20">
                            <input type="checkbox" name="is_active" id="is_active" value="1"
                                class="rounded border-gray-300 dark:border-gray-700 text-emerald-600 focus:ring-emerald-500 shrink-0"
                                @checked(old('is_active', $product->is_active ?? true))>
                            <div>
                                <span class="block text-sm font-medium text-gray-700 dark:text-gray-300">Active</span>
                                <span class="text-[10px] text-gray-400 dark:text-gray-500">Available for sale</span>
                            </div>
                        </label>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="flex items-center justify-between gap-4 bg-white dark:bg-gray-900 rounded-2xl border border-gray-200 dark:border-gray-800 p-5 transition-colors">
                    <div>
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            <i class="ph-bold ph-check-circle text-emerald-500 me-1.5" aria-hidden="true"></i>
                            All set? Save your product
                        </p>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('admin.products.index') }}" class="text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 transition px-4 py-2">Cancel</a>
                        <button type="submit" class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold px-6 py-2.5 rounded-xl text-sm transition shadow-sm inline-flex items-center gap-2">
                            <i class="ph-bold ph-{{ isset($product) ? 'floppy-disk' : 'plus-circle' }}" aria-hidden="true"></i>
                            {{ isset($product) ? 'Update Product' : 'Create Product' }}
                        </button>
                    </div>
                </div>

            </div>
        </form>
            </div>
        </div>
    </div>
</x-app-layout>
