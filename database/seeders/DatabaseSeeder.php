<?php

namespace Database\Seeders;

use App\Models\PaymentStatus;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->truncate(PaymentStatus::class);
        $this->call(PaymentStatusSeeder::class);
    }

    /**
     * @param string $modelClass
     */
    private function truncate(string $modelClass) : void
    {
        (new $modelClass)->truncate();
    }
}
