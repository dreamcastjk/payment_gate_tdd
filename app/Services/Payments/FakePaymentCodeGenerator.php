<?php


namespace App\Services\Payments;


use App\Interfaces\Payments\IPaymentCodeGenerator;

class FakePaymentCodeGenerator implements IPaymentCodeGenerator
{
    public function generate()
    {
        return 'TESTCODE12345';
    }
}
