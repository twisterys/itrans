<?php

namespace App\View\Components;

use Illuminate\View\Component;

class formUser extends Component
{
    public $user,$permissions;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($user,$permissions)
    {
        $this->user = $user;
        $this->permissions = $permissions;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form-user');
    }
}
