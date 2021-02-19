<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function create()
    {
        return view('payment.create');
    }

    public function store(PaymentRequest $request)
    {
        $request->user()->payments()->create($request->validated());
    }
}
