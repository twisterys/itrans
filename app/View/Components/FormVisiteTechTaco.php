<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormVisiteTechTaco extends Component
{
    public $visiteTechnique;
    public $taco;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($visiteTechnique = null,$taco = null)
    {
        $this->visiteTechnique = $visiteTechnique;
        $this->taco = $taco;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form-visite-tech-taco');
    }
}
