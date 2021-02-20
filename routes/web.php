<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DashboardController;

Auth::routes();

Route::get('/', DashboardController::class)->name('home')->middleware('auth');
Route::get('payments/create', [PaymentController::class, 'create'])->name('payments.create')->middleware('auth');
Route::post('payments', [PaymentController::class, 'store'])->name('payments.store')->middleware('auth');
