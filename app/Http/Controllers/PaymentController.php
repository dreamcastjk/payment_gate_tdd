<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use App\Interfaces\Payments\IPaymentCodeGenerator;

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
                'code' => app(IPaymentCodeGenerator::class)->generate()
            ]));
    }
}
