<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminPaymentController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\NotificationController;
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
    Route::get('/checkout', [OrdersController::class, 'checkout'])->name('checkout');
    Route::post('/orders', [OrdersController::class, 'store'])->name('orders.store');
    Route::get('/orders', [OrdersController::class, 'all'])->name('orders.all');
    Route::get('/orders/{order}', [OrdersController::class, 'show'])->name('orders.show');
});

Route::resource('products', ProductController::class)->middleware('auth')->middleware('can:manage-products')->except('show')->name('products', 'products.index');

Route::resource('banners', BannerController::class)->middleware('auth', 'can:manage-products')->name('banners', 'banners.index');

Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');

//resource categories
Route::get('/categories', [CategoriesController::class, 'index'])->name('categories.index')->middleware('auth', 'can:manage-products');
Route::get('/categories/create', [CategoriesController::class, 'create'])->name('categories.create')->middleware('auth', 'can:manage-products');
Route::get('/categories/{category}', [CategoriesController::class, 'show'])->name('categories.show')->middleware('auth', 'can:manage-products');
Route::post('/categories', [CategoriesController::class, 'store'])->name('categories.store')->middleware('auth', 'can:manage-products');
Route::get('/categories/{category}/edit', [CategoriesController::class, 'edit'])->name('categories.edit')->middleware('auth', 'can:manage-products');
Route::put('/categories/{category}', [CategoriesController::class, 'update'])->name('categories.update')->middleware('auth', 'can:manage-products');
Route::delete('/categories/{category}', [CategoriesController::class, 'destroy'])->name('categories.destroy')->middleware('auth', 'can:manage-products');

Route::middleware(['auth', 'can:manage-products'])->group(function () {
    Route::get('/admin/payments', [AdminPaymentController::class, 'index'])->name('admin.payments.index');
    Route::get('/admin/payments/{payment}', [AdminPaymentController::class, 'show'])->name('admin.payments.show');
    Route::post('/admin/payments/{payment}/update-status', [AdminPaymentController::class, 'updateStatus'])->name('admin.payments.updateStatus');
});

Route::resource('notifications', NotificationController::class)->middleware('auth', 'can:manage-products')->except('show')->name('notifications', 'notifications.index');
//notifications.show
Route::get('/notifications/{notification}', [NotificationController::class, 'show'])->name('notifications.show')->middleware('auth');

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


//payments.pay
Route::get('/payments/{payment}/pay', [OrdersController::class, 'pay'])->name('payments.pay')->middleware('auth');
Route::get('/t', [NotificationController::class, 'test'])->name('test-n')->middleware('auth');
Route::get('/notifications/user/all', [NotificationController::class, 'forUser'])->name('notifications.user')->middleware('auth');
Route::post('notifications/{notification}/mark-as-unread', [NotificationController::class, 'markAsUnread'])
    ->name('notifications.markAsUnread');
//payment-proof.store
Route::post('/payments/{payment}/proof', [OrdersController::class, 'storeProof'])->name('payment-proof.store')->middleware('auth');
Route::get('/check', [WiseController::class, 'getAllBalances']);

require __DIR__ . '/auth.php';
require __DIR__ . '/paypal.php';
