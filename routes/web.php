<?php

use App\Http\Controllers\Front\Auh\TowFactorAuthenticationController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\OrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    ['prefix' => LaravelLocalization::setLocale()],
    function () {
        Route::get("/", [HomeController::class,"index"])->name("home");
        Route::get('welcome', function () {
            return view('welcome');
        });
        Route::get('books/{book}',[HomeController::class, 'show'])->name('books.show');
        Route::get('auth/user/2fa',[TowFactorAuthenticationController::class, 'index'])->name('front.2fa');
        
      
        Route::prefix('cart')->name('cart.')->group(function () {
            Route::get('/', [CartController::class, 'index'])->name('index');
            Route::post('/add', [CartController::class, 'store'])->name('store');
            Route::post('/update/{id}', [CartController::class, 'update'])->name('update');
            Route::delete('/remove/{id}', [CartController::class, 'destroy'])->name('destroy');
            Route::delete('/clear', [CartController::class, 'clear'])->name('clear');
            Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
        });
        
        Route::prefix('orders')->name('orders.')->group(function () {
            Route::post('/store', [OrderController::class, 'store'])->name('store');
            Route::get('/', [OrderController::class, 'index'])->name('index')->middleware('auth');
        });
        
        // Order success page
        Route::get('/order/success/{id}', [OrderController::class, 'success'])->name('order.success');
        
        // هذا يجب أن يكون في النهاية - wildcard يأخذ كل شيء
        Route::get('/{id}', [OrderController::class, 'show'])->name('front.orders.show');
    }
);
require __DIR__ . '/dashboard.php';
