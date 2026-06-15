<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Services\CacheService;

class ShopController extends Controller
{
    public function index(CacheService $cache)
    {
        $query = Product::where('is_active', true)
            ->with('category')
            ->withAvg('reviews', 'rating');

        if ($search = request('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('origin', 'like', "%{$search}%");
            });
        }

        if ($category = request('category')) {
            $query->whereHas('category', fn($q) => $q->where('slug', $category));
        }

        if ($organic = request('organic')) {
            $query->where('is_organic', true);
        }

        if ($seasonal = request('seasonal')) {
            $query->where('is_seasonal', true);
        }

        if (request('sale')) {
            $query->activeSale();
        }

        $sort = request('sort', 'latest');

        match ($sort) {
            'oldest' => $query->oldest(),
            'cheapest' => $query->orderBy('price'),
            'most_expensive' => $query->orderByDesc('price'),
            'name_asc' => $query->orderBy('name'),
            'name_desc' => $query->orderByDesc('name'),
            default => $query->latest(),
        };

        $products = $query->paginate(12)->withQueryString();

        $categories = $cache->getCategories();

        return view('pages.shop', compact('products', 'categories'));
    }

    public function show(Product $product)
    {
        if (!$product->is_active) {
            abort(404);
        }

        $product->load('category');
        $product->loadAvg('reviews', 'rating');

        $related = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->inRandomOrder()
            ->take(4)
            ->get();

        $reviews = $product->reviews()
            ->with('user')
            ->latest()
            ->paginate(10);

        $userReview = auth()->check()
            ? $product->reviews()->where('user_id', auth()->id())->first()
            : null;

        $hasPurchased = auth()->check()
            ? Order::where('user_id', auth()->id())
                ->whereHas('items', fn($q) => $q->where('product_id', $product->id))
                ->whereIn('status', ['delivered', 'shipped', 'processing'])
                ->exists()
            : false;

        return view('pages.product-detail', compact('product', 'related', 'reviews', 'userReview', 'hasPurchased'));
    }
}
