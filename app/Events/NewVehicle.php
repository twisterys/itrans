<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;

class NewVehicle
{
    use SerializesModels;

    public $vehicle;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($vehicle)
    {
        $this->vehicle = $vehicle;
    }
}
