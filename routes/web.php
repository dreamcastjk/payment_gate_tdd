<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

Auth::routes();

Route::get('payments/create', [PaymentController::class, 'create'])->name('payments.create')->middleware('auth');
Route::post('payments', [PaymentController::class, 'store'])->name('payments.store')->middleware('auth');
