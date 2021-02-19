<?php


namespace App\Services\Payments;


use App\Interfaces\Payments\IPaymentCodeGenerator;

class UniquePaymentTestGeneratorService implements IPaymentCodeGenerator
{
    const CODE_CHARACTERS_POOL = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

    const CODE_CHARACTERS_LENGTH = 16;

    public function generate()
    {
        return substr(
            str_shuffle(str_repeat(static::CODE_CHARACTERS_POOL, static::CODE_CHARACTERS_LENGTH)),
            0 ,
            static::CODE_CHARACTERS_LENGTH
        );
    }
}
