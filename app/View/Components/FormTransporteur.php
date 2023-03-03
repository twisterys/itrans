<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormTransporteur extends Component
{
    public $transporteur;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($transporteur = null)
    {
        $this->transporteur = $transporteur;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form-transporteur');
    }
}
