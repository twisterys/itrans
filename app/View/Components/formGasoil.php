<?php

namespace App\View\Components;

use Illuminate\View\Component;

class formGasoil extends Component
{

    public $gasoil,$stations,$vehicles,$drivers;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($gasoil,$stations,$vehicles,$drivers)
    {
        $this->gasoil = $gasoil;
        $this->stations = $stations;
        $this->vehicles = $vehicles;
        $this->drivers = $drivers;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form-gasoil');
    }
}
