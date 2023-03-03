<?php

namespace App\View\Components;

use Illuminate\View\Component;

class formVente extends Component
{
    public $vente,$clients,$shemas;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($vente = null,$clients = null,$shemas = null)
    {
        $this->clients = $clients;
        $this->vente = $vente;
        $this->shemas = $shemas;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form-vente');
    }
}
