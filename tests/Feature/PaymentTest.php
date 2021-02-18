<?php

namespace Tests\Feature;

use App\Models\Payment;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PaymentTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function not_authenticated_users_cant_create_a_new_payments()
    {
        $this->withoutExceptionHandling([AuthenticationException::class]);
        $this->get(route('payments.create'))
            ->assertStatus(302)
            ->assertRedirect('login');
    }

    /**
     * @test
     */
    public function customer_can_see_a_form_for_creating_new_payment()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get(route('payments.create'))
            ->assertStatus(200)
            ->assertSee('Create new Payment');
    }

    /**
     * @test
     */
    public function user_can_not_create_a_new_payment()
    {
        $this->withoutExceptionHandling([AuthenticationException::class]);

        $userEmail = 'bradley@cooper.com';
        $amount = 5000;
        $currency = 'usd';
        $name = 'Bradley Cooper';
        $description = 'Pay me. Now';
        $message = 'Hello';

        $this->json('post', route('payments.store'), [
            'email' => $userEmail,
            'amount' => $amount,
            'currency' => $currency,
            'name' => $name,
            'description' => $description,
            'message' => $message,
        ])->assertStatus(401);

        $this->assertEquals(0, Payment::count());
    }

    /**
     * @test
     */
    public function user_can_create_a_new_payment()
    {
        $this->withoutExceptionHandling([AuthenticationException::class]);


        $userEmail = 'bradley@cooper.com';
        $amount = 5000;
        $currency = 'usd';
        $name = 'Bradley Cooper';
        $description = 'Pay me. Now';
        $message = 'Hello';

        $user = User::factory()->create(['email' => $userEmail]);

        $this->actingAs($user)->json('post', route('payments.store'), [
            'email' => $userEmail,
            'amount' => $amount,
            'currency' => $currency,
            'name' => $name,
            'description' => $description,
            'message' => $message,
        ])->assertStatus(200);

        $this->assertEquals(1, Payment::count());
        tap(Payment::first(), function (Payment $payment) use ($user, $currency, $name, $description, $message, $userEmail, $amount) {
            $this->assertEquals($user->id, $payment->user_id);
            $this->assertEquals($userEmail, $payment->email);
            $this->assertEquals($amount, $payment->amount);
            $this->assertEquals($currency, $payment->currency);
            $this->assertEquals($name, $payment->name);
            $this->assertEquals($description, $payment->description);
            $this->assertEquals($message, $payment->message);
        });
    }
}
