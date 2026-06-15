<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(CartService $cart)
    {
        return view('pages.cart', [
            'items' => $cart->getItems(),
            'total' => $cart->getTotal(),
        ]);
    }

    public function store(Request $request, CartService $cart)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($data['product_id']);
        $cart->add($product, $data['quantity']);

        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'count' => $cart->getCount(),
                'total' => number_format($cart->getTotal(), 0, ',', '.'),
                'total_raw' => $cart->getTotal(),
                'message' => "{$product->name} added to cart",
                'items' => array_values($cart->getItems()),
            ]);
        }

        return redirect()->back()->with('success', "{$product->name} added to cart");
    }

    public function update(Request $request, CartService $cart, int $productId)
    {
        $data = $request->validate(['quantity' => 'required|integer|min:1']);
        $cart->update($productId, $data['quantity']);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'count' => $cart->getCount(),
                'total' => number_format($cart->getTotal(), 0, ',', '.'),
                'items' => array_values($cart->getItems()),
            ]);
        }

        return redirect()->route('cart.index');
    }

    public function destroy(Request $request, CartService $cart, int $productId)
    {
        $cart->remove($productId);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'count' => $cart->getCount(),
                'total' => number_format($cart->getTotal(), 0, ',', '.'),
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Item removed from cart');
    }
}