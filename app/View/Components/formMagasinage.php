<?php

namespace App\View\Components;

use Illuminate\View\Component;

class formMagasinage extends Component
{

    public $magasinage,$depots,$plomos,$clients,$packages,$services,$magasinageServices,$magasinageService;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($magasinage,$depots,$plomos,$clients,$packages,$services,$magasinageServices,$magasinageService)
    {
        $this->magasinage = $magasinage;
        $this->depots = $depots;
        $this->plomos = $plomos;
        $this->clients = $clients;
        $this->packages = $packages;
        $this->services = $services;
        $this->magasinageServices = $magasinageServices;
        $this->magasinageService = $magasinageService;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form-magasinage');
    }
}
