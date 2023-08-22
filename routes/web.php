<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WiseController;
use App\Http\Livewire\Cart;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [ProductController::class, 'home'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //checkout
    Route::get('/checkout', [OrdersController::class, 'checkout'])->name('checkout');

    //orders.store
    Route::post('/orders', [OrdersController::class, 'store'])->name('orders.store');
    //orders.show
    Route::get('/orders', [OrdersController::class, 'all'])->name('orders.all');
    Route::get('/orders/{order}', [OrdersController::class, 'show'])->name('orders.show');
});

Route::resource('products', ProductController::class)->middleware('auth')->middleware('can:manage-products')->except('show')->name('products', 'products.index');

Route::resource('banners', BannerController::class)->middleware('auth', 'can:manage-products')->name('banners', 'banners.index');

Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

Route::get('/categories', [CategoriesController::class, 'index'])->name('categories.index')->middleware('auth', 'can:manage-products');

Route::get('/cart', Cart::class)->name('cart');

Route::get('/users', [AdminController::class, 'users'])->name('users')->middleware('auth', 'can:manage-products');
Route::get('/admin', [AdminController::class, 'index'])->name('admin')->middleware('auth', 'can:manage-products');
Route::get('/users/{user}', [AdminController::class, 'show'])->name('users.show')->middleware('auth', 'can:manage-products');
//all orders admin
Route::get('/admin/orders', [AdminController::class, 'orders'])->name('admin-orders')->middleware('auth', 'can:manage-products');
//show an order admin
Route::get('/admin/orders/{order}', [AdminController::class, 'showOrder'])->name('admin-show-order')->middleware('auth', 'can:manage-products');
//admin.orders.update (update order status)
Route::patch('/admin/orders/{order}', [AdminController::class, 'updateOrderStatus'])->name('order-update-status')->middleware('auth', 'can:manage-products');



//Wise API
Route::get('/check', [WiseController::class, 'getAllBalances']);







require __DIR__.'/auth.php';
