<?php

namespace App\View\Components;

use Illuminate\View\Component;

class formFacture extends Component
{
    public $facture,$clients,$shemas;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($facture = null,$clients = null,$shemas = null)
    {
        $this->facture = $facture;
        $this->clients = $clients;
        $this->shemas = $shemas;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form-facture');
    }
}
