<?php

namespace App\View\Components;

use Illuminate\View\Component;

class formImportItem extends Component
{
    public $importItem,$clients,$transitaires;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($importItem = null,$clients = null,$transitaires = null)
    {
        $this->importItem = $importItem;
        $this->clients = $clients;
        $this->transitaires = $transitaires;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form-import-item');
    }
}
