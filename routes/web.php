<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

use App\Http\Controllers\OrderController;





/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/car/{name}', [CarController::class, 'show'])->name('car.show');
Route::get('/product/{name}', [ProductController::class, 'show'])->name('product.show');
Route::get('/', [HomeController::class, 'index']);

Route::post('/cart/update', [CartController::class, 'updateCart'])->name('cart.update');

Route::get('/cart', [CartController::class, 'viewCart'])->name('cart.view');
Route::post('/cart/quantity', [CartController::class, 'updateQuantity'])->name('cart.quantity');


Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
Route::get('/order/success/{id}', [OrderController::class, 'success'])->name('order.success');