<?php

namespace App\View\Components;

use Illuminate\View\Component;

class formExctinteur extends Component
{
    public $vehicle;
    public $exctinteur;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($vehicle = null,$exctinteur = null)
    {
        $this->vehicle = $vehicle;
        $this->exctinteur = $exctinteur;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form-exctinteur');
    }
}
