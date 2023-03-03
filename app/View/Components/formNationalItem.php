<?php

namespace App\View\Components;

use Illuminate\View\Component;

class formNationalItem extends Component
{

    public $nationalItem;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($nationalItem = null)
    {
        $this->nationalItem = $nationalItem;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form-national-item');
    }
}
