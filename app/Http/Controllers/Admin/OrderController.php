<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Notifications\OrderStatusNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::withCount('items')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('items.product', 'user');

        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $data = $request->validate([
            'status' => 'required|in:pending,confirmed,processing,shipped,delivered,cancelled',
        ]);

        $oldStatus = $order->status;
        $order->update($data);

        Cache::forget('admin.dashboard.stats');
        Cache::forget('admin.dashboard.orders_by_status');
        Cache::forget('admin.dashboard.recent_orders');

        if ($order->user) {
            $order->user->notify(new OrderStatusNotification($order, $oldStatus, $order->status));
        }

        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Status pesanan berhasil diperbarui.');
    }

    public function updatePayment(Request $request, Order $order)
    {
        $data = $request->validate([
            'payment_status' => 'required|in:pending,paid,failed,refunded',
        ]);

        $oldStatus = $order->payment_status;
        $order->update($data);

        Cache::forget('admin.dashboard.stats');
        Cache::forget('admin.dashboard.orders_by_status');

        if ($order->user && $oldStatus !== $order->payment_status) {
            $order->user->notify(new OrderStatusNotification($order, 'payment_'.$oldStatus, 'payment_'.$order->payment_status));
        }

        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Status pembayaran berhasil diperbarui.');
    }
}
