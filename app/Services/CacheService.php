<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Cache;

class CacheService
{
    public function getCategories()
    {
        return Cache::remember('categories.active', 3600, function () {
            return Category::where('is_active', true)->get();
        });
    }

    public function getFeaturedProducts()
    {
        return Cache::remember('products.featured', 600, function () {
            return Product::where('is_featured', true)
                ->where('is_active', true)
                ->with('category')
                ->withAvg('reviews', 'rating')
                ->take(8)
                ->get();
        });
    }

    public function getFlashSales()
    {
        return Cache::remember('products.flash_sales', 300, function () {
            return Product::activeSale()
                ->where('is_active', true)
                ->with('category')
                ->withAvg('reviews', 'rating')
                ->take(4)
                ->get();
        });
    }

    public function forgetCategories(): void
    {
        Cache::forget('categories.active');
    }

    public function forgetFeaturedProducts(): void
    {
        Cache::forget('products.featured');
    }

    public function forgetFlashSales(): void
    {
        Cache::forget('products.flash_sales');
    }

    public function clearAll(): void
    {
        Cache::flush();
    }
}
