<?php

namespace App\View\Components;

use Illuminate\View\Component;

class formStation extends Component
{

    public $station;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($station)
    {
        $this->station = $station;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form-station');
    }
}
