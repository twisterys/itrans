<?php

namespace App\View\Components;

use Illuminate\View\Component;

class formExport extends Component
{

    public $export,$vehicles,$typesVehicle,$typesFrais,$drivers;
    public $plomos,$clients,$transitaires,$chauffeurs;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($drivers = null,$export = null,$vehicles=null,$typesVehicle = null,$typesFrais = null,$plomos = null,$clients = null,$transitaires = null,$chauffeurs = null)
    {
        $this->export = $export;
        $this->vehicles = $vehicles;
        $this->typesVehicle = $typesVehicle;
        $this->typesFrais = $typesFrais;
        $this->drivers = $drivers;
        $this->plomos = $plomos;
        $this->clients = $clients;
        $this->transitaires = $transitaires;
        $this->chauffeurs = $chauffeurs;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form-export');
    }
}
