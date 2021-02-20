<?php

namespace Database\Seeders;

use App\Models\PaymentStatus;
use Illuminate\Database\Seeder;

class PaymentStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentStatus::factory()->createMany([
            [
                'code' => 'new',
                'label' => 'New',
                'description' => 'This status represents that payment has been created but never sent.'
            ],
            [
                'code' => 'sent',
                'label' => 'Sent',
                'description' => 'This status represents that payment has been sent.'
            ],
        ]);
    }
}
