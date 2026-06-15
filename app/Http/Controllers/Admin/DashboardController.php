<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = Cache::remember('admin.dashboard.stats', 300, function () {
            return [
                'totalOrders' => Order::count(),
                'totalRevenue' => Order::where('status', '!=', 'cancelled')->sum('total'),
                'pendingOrders' => Order::where('status', 'pending')->count(),
                'totalProducts' => Product::count(),
                'totalCategories' => Category::count(),
                'totalUsers' => User::count(),
            ];
        });

        $recentOrders = Cache::remember('admin.dashboard.recent_orders', 300, function () {
            return Order::with('items')
                ->orderBy('created_at', 'desc')
                ->take(10)
                ->get();
        });

        $monthlyRevenue = Cache::remember('admin.dashboard.monthly_revenue', 300, function () {
            return Order::selectRaw('MONTH(created_at) as month, SUM(total) as total')
                ->where('status', '!=', 'cancelled')
                ->whereYear('created_at', now()->year)
                ->groupBy('month')
                ->orderBy('month')
                ->pluck('total', 'month');
        });

        $ordersByStatus = Cache::remember('admin.dashboard.orders_by_status', 300, function () {
            return Order::selectRaw('status, COUNT(*) as count')
                ->groupBy('status')
                ->pluck('count', 'status');
        });

        $topProducts = Cache::remember('admin.dashboard.top_products', 300, function () {
            return OrderItem::select('product_name', DB::raw('SUM(quantity) as total_qty'), DB::raw('SUM(subtotal) as total_revenue'))
                ->groupBy('product_name')
                ->orderByDesc('total_qty')
                ->take(5)
                ->get();
        });

        return view('admin.dashboard', [
            'totalOrders' => $stats['totalOrders'],
            'totalRevenue' => $stats['totalRevenue'],
            'pendingOrders' => $stats['pendingOrders'],
            'totalProducts' => $stats['totalProducts'],
            'totalCategories' => $stats['totalCategories'],
            'totalUsers' => $stats['totalUsers'],
            'recentOrders' => $recentOrders,
            'monthlyRevenue' => $monthlyRevenue,
            'ordersByStatus' => $ordersByStatus,
            'topProducts' => $topProducts,
        ]);
    }
}
