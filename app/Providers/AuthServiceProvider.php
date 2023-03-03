<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
         'App\Vehicle' => 'App\Policies\VehiclePolicy',
         'App\Magasinage' => 'App\Policies\MagasinagePolicy',
         'App\Person' => 'App\Policies\PersonPolicy',
         'App\Dossier' => 'App\Policies\DossierPolicy',
         'App\Gasoil' => 'App\Policies\GasoilPolicy',
         'App\User' => 'App\Policies\UserPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
