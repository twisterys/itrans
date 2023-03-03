<?php

namespace App\View\Components;

use Illuminate\View\Component;

class formShema extends Component
{
    public $shema;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($shema)
    {
        $this->shema = $shema;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form-shema');
    }
}
