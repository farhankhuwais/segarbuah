<?php

namespace App\View\Composers;

use App\Services\CartService;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class CartComposer
{
    protected CartService $cart;

    public function __construct(CartService $cart)
    {
        $this->cart = $cart;
    }

    public function compose(View $view): void
    {
        $view->with('cartCount', $this->cart->getCount());
        $view->with('cartItems', $this->cart->getItems());
        $view->with('cartTotal', $this->cart->getTotal());

        if (auth()->check()) {
            $user = auth()->user();

            $wishlistCount = Cache::remember("user.{$user->id}.wishlist_count", 60, function () use ($user) {
                return $user->wishlist()->count();
            });

            $unreadCount = Cache::remember("user.{$user->id}.unread_notifications", 60, function () use ($user) {
                return $user->unreadNotifications()->count();
            });

            $recentNotifs = Cache::remember("user.{$user->id}.recent_notifications", 60, function () use ($user) {
                return $user->notifications()->orderBy('created_at', 'desc')->take(5)->get();
            });

            $view->with('wishlistCount', $wishlistCount);
            $view->with('unreadCount', $unreadCount);
            $view->with('recentNotifs', $recentNotifs);
        } else {
            $view->with('wishlistCount', 0);
            $view->with('unreadCount', 0);
            $view->with('recentNotifs', collect());
        }
    }
}
