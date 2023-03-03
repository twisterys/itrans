<?php

namespace App\View\Components;

use Illuminate\View\Component;

class formClient extends Component
{
    public $client,$typeClient;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($client,$typeClient)
    {
        $this->client = $client;
        $this->typeClient = $typeClient;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form-client');
    }
}
