<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\Payments\IPaymentCodeGenerator;
use App\Services\Payments\UniquePaymentTestGeneratorService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(IPaymentCodeGenerator::class, UniquePaymentTestGeneratorService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
