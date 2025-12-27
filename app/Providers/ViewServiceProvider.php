<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cookie;
use App\Models\Cart;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Share cart count with all views
        View::composer('*', function ($view) {
            $cookieId = Cookie::get('cart_id');
            
            $cartCount = 0;
            $cartItems = collect([]);
            
            if ($cookieId) {
                $cartCount = Cart::where('cookie_id', $cookieId)->sum('quantity');
                $cartItems = Cart::with('book')
                    ->where('cookie_id', $cookieId)
                    ->limit(5) // Only get last 5 items for dropdown
                    ->latest()
                    ->get();
            }
            
            $view->with([
                'cartCount' => $cartCount,
                'cartItems' => $cartItems,
            ]);
        });
    }
}