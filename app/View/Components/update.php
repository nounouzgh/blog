<?php

namespace App\View\Components;

use Illuminate\View\Component;

class update extends Component
{
    public $profileNumber;
    public $name;
    public $cour;
    public $description;
    public $timer;

    /**
     * Create a new component instance.
     *
     * @param  int  $profileNumber
     * @param  string  $name
     * @param  string  $cour
     * @param  string  $description
     * @param  string  $timer
     * @return void
     */
    public function __construct($profileNumber, $name, $cour, $description, $timer)
    {
        $this->profileNumber = $profileNumber;
        $this->name = $name;
        $this->cour = $cour;
        $this->description = $description;
        $this->timer = $timer;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.announce.update');
    }
}
