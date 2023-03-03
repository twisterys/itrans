<?php

namespace App\View\Components;

use Illuminate\View\Component;

class formVehicle extends Component
{
    public $vehicle;
    public $typeVehicles;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($vehicle = null,$typeVehicles = null)
    {
        $this->vehicle = $vehicle;
        $this->typeVehicles = $typeVehicles;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form-vehicle');
    }
}
