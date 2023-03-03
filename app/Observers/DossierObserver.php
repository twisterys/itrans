<?php

namespace App\Observers;

use App\Dossier;

class DossierObserver
{
    /**
     * Handle the dossier "created" event.
     *
     * @param  \App\Dossier  $dossier
     * @return void
     */
    public function created(Dossier $dossier)
    {
        //
    }

    /**
     * Handle the dossier "updated" event.
     *
     * @param  \App\Dossier  $dossier
     * @return void
     */
    public function updated(Dossier $dossier)
    {
        //
    }

    /**
     * Handle the dossier "deleted" event.
     *
     * @param  \App\Dossier  $dossier
     * @return void
     */
    public function deleting(Dossier $dossier)
    {
        $dossier->dossierItems()->delete();
        $dossier->personalExpenses()->delete();
        $dossier->dossierVehicles()->delete();
    }

    /**
     * Handle the dossier "restored" event.
     *
     * @param  \App\Dossier  $dossier
     * @return void
     */
    public function restored(Dossier $dossier)
    {
        //
    }

    /**
     * Handle the dossier "force deleted" event.
     *
     * @param  \App\Dossier  $dossier
     * @return void
     */
    public function forceDeleted(Dossier $dossier)
    {
        //
    }
}
