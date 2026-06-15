<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    public function index(CartService $cart)
    {
        if (!$cart->getCount()) {
            return redirect()->route('cart.index');
        }

        return view('pages.checkout', [
            'items' => $cart->getItems(),
            'total' => $cart->getTotal(),
            'shippingCost' => 0,
        ]);
    }

    public function store(Request $request, CartService $cart)
    {
        $data = $request->validate([
            'shipping_name' => 'required|string|max:255',
            'shipping_phone' => 'required|string|max:20',
            'shipping_address' => 'required|string|max:500',
            'shipping_city' => 'required|string|max:255',
            'shipping_postal_code' => 'required|string|max:10',
            'notes' => 'nullable|string|max:1000',
            'payment_method' => 'required|in:bank_transfer,cod,qris',
        ]);

        if (!$cart->getCount()) {
            return back()->withErrors(['cart' => 'Your cart is empty']);
        }

        $shippingCost = ($cart->getTotal() >= 100000) ? 0 : 15000;
        $subtotal = $cart->getTotal();
        $total = $subtotal + $shippingCost;

        $order = Order::create([
            'user_id' => auth()->id(),
            'order_number' => 'INV-' . now()->format('Ymd') . '-' . strtoupper(Str::random(6)),
            'status' => 'pending',
            'subtotal' => $subtotal,
            'shipping_cost' => $shippingCost,
            'total' => $total,
            ...$data,
            'payment_status' => 'pending',
        ]);

        foreach ($cart->getItems() as $id => $item) {
            $order->items()->create([
                'product_id' => $id,
                'product_name' => $item['name'],
                'product_price' => $item['price'],
                'quantity' => $item['quantity'],
                'subtotal' => $item['price'] * $item['quantity'],
            ]);
        }

        $cart->clear();

        return redirect()->route('checkout.success', $order->id);
    }

    public function success(Order $order)
    {
        if ($order->user_id && $order->user_id !== auth()->id()) {
            abort(403);
        }

        return view('pages.checkout-success', compact('order'));
    }
}