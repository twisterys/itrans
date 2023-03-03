<?php

namespace App\View\Components;

use Illuminate\View\Component;

class formTechnicalVisit extends Component
{
    public $vehicle;
    public $technicalVisit;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($vehicle = null,$technicalVisit = null)
    {
        $this->vehicle = $vehicle;
        $this->technicalVisit = $technicalVisit;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form-technical-visit');
    }
}
