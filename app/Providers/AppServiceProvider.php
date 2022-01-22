<?php

namespace App\Providers;

use App\Contracts\Service\ScheduleDeliveryServiceContract;
use App\Services\ScheduleDeliveryService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ScheduleDeliveryServiceContract::class, ScheduleDeliveryService::class);
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
