<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()
            ->with('items')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('pages.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(404);
        }

        $order->load('items.product');

        return view('pages.orders.show', compact('order'));
    }

    public function confirm(Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            abort(404);
        }

        $order->update([
            'payment_status' => 'paid',
            'payment_proof' => 'manual_confirmation',
        ]);

        return redirect()->route('orders.show', $order)
            ->with('success', 'Pembayaran berhasil dikonfirmasi. Tim kami akan memverifikasi pesanan Anda.');
    }
}
