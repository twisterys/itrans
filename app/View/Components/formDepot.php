<?php

namespace App\View\Components;

use Illuminate\View\Component;

class formDepot extends Component
{
    public $depot;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($depot)
    {
        $this->depot = $depot;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form-depot');
    }
}
