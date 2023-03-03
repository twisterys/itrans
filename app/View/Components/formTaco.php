<?php

namespace App\View\Components;

use Illuminate\View\Component;

class formTaco extends Component
{
    public $vehicle;
    public $taco;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($vehicle = null,$taco = null)
    {
        $this->vehicle = $vehicle;
        $this->taco = $taco;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form-taco');
    }
}
