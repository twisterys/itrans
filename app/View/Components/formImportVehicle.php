<?php

namespace App\View\Components;

use Illuminate\View\Component;

class formImportVehicle extends Component
{
    public $v;
    public $importVehicle;
    public $typeVehicle;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($v = null,$importVehicle = null,$typeVehicle = null)
    {
        $this->v = $v;
        $this->importVehicle = $importVehicle;
        $this->typeVehicle = $typeVehicle;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form-import-vehicle');
    }
}
