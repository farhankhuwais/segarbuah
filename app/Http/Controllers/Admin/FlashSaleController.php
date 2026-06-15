<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\CacheService;
use Illuminate\Http\Request;

class FlashSaleController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('name')->paginate(30);
        return view('admin.flash-sale', compact('products'));
    }

    public function update(Request $request, Product $product, CacheService $cache)
    {
        $data = $request->validate([
            'sale_price' => 'nullable|numeric|min:0|lt:price',
            'sale_starts_at' => 'nullable|date',
            'sale_ends_at' => 'nullable|date|after:sale_starts_at',
        ]);

        if (!$data['sale_price']) {
            $data['sale_price'] = null;
            $data['sale_starts_at'] = null;
            $data['sale_ends_at'] = null;
        }

        $product->update($data);
        $cache->forgetFlashSales();
        $cache->forgetFeaturedProducts();

        return redirect()->route('admin.flash-sale.index')
            ->with('success', "Flash sale for '{$product->name}' updated.");
    }
}
