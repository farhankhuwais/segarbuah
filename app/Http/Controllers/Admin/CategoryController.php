<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\CacheService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->orderBy('name')->paginate(20);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.form');
    }

    public function store(Request $request, CacheService $cache)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable|max:500',
            'image' => 'nullable|max:500',
            'is_active' => 'boolean',
        ]);

        $data['slug'] = Str::slug($data['name']);
        $data['is_active'] = $request->boolean('is_active');

        Category::create($data);
        $cache->forgetCategories();

        return redirect()->route('admin.categories.index')->with('success', 'Category created.');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.form', compact('category'));
    }

    public function update(Request $request, Category $category, CacheService $cache)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'description' => 'nullable|max:500',
            'image' => 'nullable|max:500',
            'is_active' => 'boolean',
        ]);

        $data['slug'] = Str::slug($data['name']);
        $data['is_active'] = $request->boolean('is_active');

        $category->update($data);
        $cache->forgetCategories();

        return redirect()->route('admin.categories.index')->with('success', 'Category updated.');
    }

    public function destroy(Category $category, CacheService $cache)
    {
        if ($category->products()->count() > 0) {
            return redirect()->route('admin.categories.index')
                ->with('error', 'Cannot delete category with ' . $category->products()->count() . ' product(s). Move products first.');
        }
        $category->delete();
        $cache->forgetCategories();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted.');
    }
}
