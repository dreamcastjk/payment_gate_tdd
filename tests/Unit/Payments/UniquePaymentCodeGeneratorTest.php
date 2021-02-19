<?php

namespace Tests\Unit\Payments;

use Tests\TestCase;
use App\Services\Payments\UniquePaymentTestGeneratorService;

class UniquePaymentCodeGeneratorTest extends TestCase
{
    // code must be 16 characters long
    // it can only contain uppercase letters and numbers
    // it must be unique

    /**
     * @test
     */
    public function code_must_be_16_characters_long()
    {
        $generatorService = new UniquePaymentTestGeneratorService();

        $code = $generatorService->generate();

        $this->assertEquals(TestCase::UNIQUE_CODE_LENGTH, strlen($code));
    }

    /**
     * @test
     */
    public function code_can_only_contain_uppercase_letters_and_numbers()
    {
        $generatorService = new UniquePaymentTestGeneratorService();

        $code = $generatorService->generate();

        $this->assertMatchesRegularExpression('/^[A-Z0-9]*$/', $code);
    }

    /**
     * @test
     */
    public function code_must_be_unique()
    {
        $codes = collect();
        for ($i=0; $i < 1000; $i++) {
            $codes->push((new UniquePaymentTestGeneratorService())->generate());
        }

        $this->assertEquals($codes->count(), $codes->unique()->count());
    }
}
