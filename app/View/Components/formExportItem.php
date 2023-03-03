<?php

namespace App\View\Components;

use Illuminate\View\Component;

class formExportItem extends Component
{
    public $exportItem;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($exportItem = null)
    {
        $this->exportItem = $exportItem;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form-export-item');
    }
}
