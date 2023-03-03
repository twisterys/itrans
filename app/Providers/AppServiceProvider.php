<?php

namespace App\Providers;

use App\Dossier;
use App\Observers\DossierObserver;
use App\Observers\TacoObserver;
use App\Observers\VehicleObserver;
use App\Taco;
use App\Vehicle;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Vehicle::observe(VehicleObserver::class);
        Taco::observe(TacoObserver::class);
        Dossier::observe(DossierObserver::class);
    }
}
