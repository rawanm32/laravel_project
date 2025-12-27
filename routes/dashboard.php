<?php

use App\Http\Controllers\Dashboard\BookController;
use App\Http\Controllers\Dashboard\AuthorController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\ProfileController;
use App\Http\Controllers\Dashboard\AdminsController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\RolesController;
use Illuminate\Support\Facades\Route;


 Route::middleware(['auth:admin'])->group(function () { 
    Route::group([
      'prefix' => LaravelLocalization::setLocale() . '/admin/dashboard', 
    'middleware' => ['auth:admin,web'] ,
    'as' => 'dashboard.',      
  
    ], function () {
          Route::get('/index', [DashboardController::class, 'index'])->name('index');
          Route::resource('books', BookController::class);
          Route::resource('authors', AuthorController::class);
          Route::resource('categories', CategoryController::class);
          Route::resource('users', UserController::class);
          Route::resource('roles',RolesController::class);
         Route::resource('admins',AdminsController::class);  
    });
 });


 Route::prefix('admin/dashboard')
   ->name('dashboard.')
   ->middleware(['auth:admin']) 
   ->group(function () {
        Route::get('profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('profile/update', [ProfileController::class, 'update'])->name('profile.update');
});

Route::prefix('admin/dashboard')->name('dashboard.')->middleware(['auth:admin'])->group(function () {
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::group([
    'prefix' => LaravelLocalization::setLocale() . '/admin/dashboard',
    'middleware' => ['auth:admin,web'] ,
    ], function () {
        Route::resource('roles',RolesController::class);
        Route::resource('admins',AdminsController::class);    
      }
    
);

