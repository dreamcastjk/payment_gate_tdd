<?php


namespace App\Services\Payments;


use App\Interfaces\Payments\IPaymentCodeGenerator;

class FakePaymentCodeGeneratorService implements IPaymentCodeGenerator
{
    public function generate()
    {
        return 'TESTCODE12345';
    }
}
