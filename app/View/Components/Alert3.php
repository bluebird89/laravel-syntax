<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert3 extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return <<<'blade'
        <div class="alert alert-danger">
            {{ $slot }}
        </div>
blade;
    }
}
