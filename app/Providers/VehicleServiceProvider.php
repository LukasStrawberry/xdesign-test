<?php

namespace App\Providers;

use App\Model\Vehicle\Vehicle;
use App\Repository\Vehicle\VehicleInterface;
use App\Repository\Vehicle\VehicleRepository;
use App\Service\Vehicle\VehicleService;
use Illuminate\Support\ServiceProvider;

class VehicleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(VehicleInterface::class, function($app)
        {
            return new VehicleRepository(new Vehicle());
        });

        $this->app->bind(VehicleService::class, function ($app) {
            return new VehicleService($app->make(VehicleInterface::class), config('vehicle.xsd'));
        });
    }
}
