<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;

Auth::routes();

Route::get('payment/new', [PaymentController::class, 'create'])->name('payments.create')->middleware('auth');
