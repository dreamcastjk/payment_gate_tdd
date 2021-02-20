<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Interfaces\Payments\IPaymentCodeGenerator;
use App\Models\PaymentStatus;

class PaymentController extends Controller
{
    public function create()
    {
        return view('payment.create');
    }

    public function store(PaymentRequest $request)
    {
        $request->user()
            ->payments()
            ->create(array_merge($request->validated(), [
                'code' => app(IPaymentCodeGenerator::class)->generate(),
                'status_id' => PaymentStatus::NEW
            ]));
    }
}
