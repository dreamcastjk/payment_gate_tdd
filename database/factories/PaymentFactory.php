<?php

namespace Database\Factories;

use App\Interfaces\Payments\IPaymentCodeGenerator;
use App\Models\Payment;
use App\Models\PaymentStatus;
use App\Models\User;
use App\Services\Payments\UniquePaymentTestGeneratorService;
use Facade\FlareClient\Stacktrace\Stacktrace;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Payment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory()->create()->id,
            'status_id' => PaymentStatus::factory()->create()->id,
            'email' => $this->faker->email,
            'amount' => random_int(100, 1000),
            'currency' => $this->faker->word,
            'name' => $this->faker->name,
            'description' => $this->faker->sentence,
            'message' => $this->faker->word,
            'code' => app(IPaymentCodeGenerator::class)->generate(),
        ];
    }
}
