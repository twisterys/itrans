<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormTypeVehicle extends Component
{
    public $typeVehicle;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($typeVehicle = null)
    {
        $this->typeVehicle = $typeVehicle;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form-type-vehicle');
    }
}
