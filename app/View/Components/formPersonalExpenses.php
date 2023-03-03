<?php

namespace App\View\Components;

use Illuminate\View\Component;

class formPersonalExpenses extends Component
{

    public $personalExpense;
    public $typeFrais;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($personalExpense = null,$typeFrais = null)
    {
        $this->personalExpense = $personalExpense;
        $this->typeFrais = $typeFrais;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form-personal-expenses');
    }
}
