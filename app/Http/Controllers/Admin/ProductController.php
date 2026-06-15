<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Services\CacheService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->orderBy('created_at', 'desc')->paginate(20);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        return view('admin.products.form', compact('categories'));
    }

    public function store(Request $request, CacheService $cache)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|max:255',
            'description' => 'nullable',
            'price' => 'required|numeric|min:0',
            'compare_price' => 'nullable|numeric|min:0|gt:price',
            'stock' => 'required|integer|min:0',
            'sku' => 'required|max:100|unique:products,sku',
            'unit' => 'required|max:20',
            'weight_in_grams' => 'nullable|numeric|min:0',
            'origin' => 'nullable|max:255',
            'is_organic' => 'boolean',
            'is_seasonal' => 'boolean',
            'storage_info' => 'nullable|max:500',
            'min_order' => 'nullable|numeric|min:0',
            'image' => 'nullable|max:500',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        $data['slug'] = Str::slug($data['name']);
        $data['is_organic'] = $request->boolean('is_organic');
        $data['is_seasonal'] = $request->boolean('is_seasonal');
        $data['is_active'] = $request->boolean('is_active');
        $data['is_featured'] = $request->boolean('is_featured');

        Product::create($data);
        $cache->forgetFeaturedProducts();
        $cache->forgetFlashSales();

        return redirect()->route('admin.products.index')->with('success', 'Product created.');
    }

    public function edit(Product $product)
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        return view('admin.products.form', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product, CacheService $cache)
    {
        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|max:255',
            'description' => 'nullable',
            'price' => 'required|numeric|min:0',
            'compare_price' => 'nullable|numeric|min:0|gt:price',
            'stock' => 'required|integer|min:0',
            'sku' => 'required|max:100|unique:products,sku,' . $product->id,
            'unit' => 'required|max:20',
            'weight_in_grams' => 'nullable|numeric|min:0',
            'origin' => 'nullable|max:255',
            'is_organic' => 'boolean',
            'is_seasonal' => 'boolean',
            'storage_info' => 'nullable|max:500',
            'min_order' => 'nullable|numeric|min:0',
            'image' => 'nullable|max:500',
            'is_active' => 'boolean',
            'is_featured' => 'boolean',
        ]);

        $data['slug'] = Str::slug($data['name']);
        $data['is_organic'] = $request->boolean('is_organic');
        $data['is_seasonal'] = $request->boolean('is_seasonal');
        $data['is_active'] = $request->boolean('is_active');
        $data['is_featured'] = $request->boolean('is_featured');

        $product->update($data);
        $cache->forgetFeaturedProducts();
        $cache->forgetFlashSales();

        return redirect()->route('admin.products.index')->with('success', 'Product updated.');
    }

    public function destroy(Product $product, CacheService $cache)
    {
        $product->delete();
        $cache->forgetFeaturedProducts();
        $cache->forgetFlashSales();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted.');
    }
}
