<?php

namespace App\Providers;

use App\Services\CacheService;
use App\Services\CartService;
use App\View\Composers\CartComposer;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(CartService::class);
        $this->app->singleton(CacheService::class);
    }

    public function boot(): void
    {
        URL::forceScheme('https');
        View::composer('*', CartComposer::class);
    }
}
