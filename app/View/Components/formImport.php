<?php

namespace App\View\Components;

use Illuminate\View\Component;

class formImport extends Component
{
    public $import;
    public $drivers;
    public $vehicles;
    public $typesVehicle;
    public $typesFrais;
    public $plomos,$clients,$transitaires,$chauffeurs;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($import = null,$drivers = null,$vehicles=null,$typesVehicle = null,$typesFrais = null,$plomos = null,$clients = null,$transitaires = null,$chauffeurs = null)
    {
        $this->import = $import;
        $this->drivers = $drivers;
        $this->vehicles = $vehicles;
        $this->typesVehicle = $typesVehicle;
        $this->typesFrais = $typesFrais;
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
        return view('components.form-import');
    }
}
