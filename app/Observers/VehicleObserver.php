<?php

namespace App\Observers;

use App\Vehicle;

class VehicleObserver
{
    /**
     * Handle the vehicle "created" event.
     *
     * @param  \App\Vehicle  $vehicle
     * @return void
     */
    public function created(Vehicle $vehicle)
    {
        //
    }

    /**
     * Handle the vehicle "updated" event.
     *
     * @param  \App\Vehicle  $vehicle
     * @return void
     */
    public function updated(Vehicle $vehicle)
    {
        //
    }

    /**
     * Handle the vehicle "deleted" event.
     *
     * @param  \App\Vehicle  $vehicle
     * @return void
     */
    public function deleting(Vehicle $vehicle)
    {
        $vehicle->assurances()->delete();
        $vehicle->technicalVisits()->delete();
        $vehicle->tacos()->delete();
        $vehicle->extinteurs()->delete();
    }

    /**
     * Handle the vehicle "restored" event.
     *
     * @param  \App\Vehicle  $vehicle
     * @return void
     */
    public function restored(Vehicle $vehicle)
    {
        //
    }

    /**
     * Handle the vehicle "force deleted" event.
     *
     * @param  \App\Vehicle  $vehicle
     * @return void
     */
    public function forceDeleted(Vehicle $vehicle)
    {
        //
    }
}
