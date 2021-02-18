<?php

namespace Tests\Feature;

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
}
