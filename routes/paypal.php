<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

Route::get('pay', [PaymentController::class, 'payment'])->name('paypal.payment');
Route::get('success', [PaymentController::class, 'success'])->name('paypal.success');
Route::get('cancel', [PaymentController::class, 'cancel'])->name('paypal.cancel');
