<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Services\CacheService;

class HomeController extends Controller
{
    public function __invoke(CacheService $cache)
    {
        $featuredProducts = $cache->getFeaturedProducts();
        $flashSales = $cache->getFlashSales();
        $categories = $cache->getCategories();

        return view('pages.home', compact('featuredProducts', 'flashSales', 'categories'));
    }
}
