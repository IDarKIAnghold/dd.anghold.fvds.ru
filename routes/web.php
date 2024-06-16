<?php

use Inertia\Inertia;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GetController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\OrderController;

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/about', [HomeController::class, 'about'])->name('about');

Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::post('/cart/check', [CartController::class, 'checkCart'])->name('checkCart');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('addToCart');
Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('removeFromCart');
Route::post('/cart/update', [CartController::class, 'updateQuantity'])->name('updateQuantity');
Route::post('/cart/clear', [CartController::class, 'clearCart'])->name('clearCart');

Route::get('/favorite', [FavoriteController::class, 'view'])->name('favorite');
Route::post('/favorite/check', [FavoriteController::class, 'checkFavorite'])->name('checkFavorite');
Route::post('/favorite/add', [FavoriteController::class, 'addToFavorite'])->name('addToFavorite');
Route::post('/favorite/remove', [FavoriteController::class, 'removeFromFavorite'])->name('removeFromFavorite');

Route::get('/order', [OrderController::class, 'view'])->name('orderView');
Route::put('/order/done', [OrderController::class, 'viewDone'])->name('orderViewDone');
Route::post('/order/set', [OrderController::class, 'setOrder'])->name('orderSet');

Route::get('/product/{slug}/{state?}', [GetController::class, 'product'])->name('product');

Route::match(['get', 'put'], '/type/{type}', [GetController::class, 'catalogType'])->name('type');
Route::get('/category/{type}', [GetController::class, 'catalogCategory'])->name('category');

require __DIR__ . '/auth.php';
