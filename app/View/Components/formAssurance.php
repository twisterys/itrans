<?php

namespace App\View\Components;

use App\Vehicle;
use Illuminate\View\Component;

class formAssurance extends Component
{
    public $vehicle;
    public $assurance;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($vehicle = null,$assurance=null)
    {
        $this->vehicle = $vehicle;
        $this->assurance = $assurance;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form-assurance');
    }
}
