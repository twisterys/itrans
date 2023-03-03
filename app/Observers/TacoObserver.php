<?php

namespace App\Observers;

use App\Taco;

class TacoObserver
{
    /**
     * Handle the taco "created" event.
     *
     * @param  \App\Taco  $taco
     * @return void
     */
    public function created(Taco $taco)
    {
        //
    }

    /**
     * Handle the taco "updated" event.
     *
     * @param  \App\Taco  $taco
     * @return void
     */
    public function updated(Taco $taco)
    {
        //
    }

    /**
     * Handle the taco "deleted" event.
     *
     * @param  \App\Taco  $taco
     * @return void
     */
    public function deleting(Taco $taco)
    {
        $taco->visitTechnique()->delete();
    }

    /**
     * Handle the taco "restored" event.
     *
     * @param  \App\Taco  $taco
     * @return void
     */
    public function restored(Taco $taco)
    {
        //
    }

    /**
     * Handle the taco "force deleted" event.
     *
     * @param  \App\Taco  $taco
     * @return void
     */
    public function forceDeleted(Taco $taco)
    {
        //
    }
}
