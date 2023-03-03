<?php

namespace App\View\Components;

use Illuminate\View\Component;

class formAssuranceTravail extends Component
{
    public $assurance;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($assurance = null)
    {
        $this->assurance = $assurance;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form-assurance-travail');
    }
}
