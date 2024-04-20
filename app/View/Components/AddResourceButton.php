<?php

namespace App\View\Components;
use Illuminate\View\Component;

class AddResourceButton extends Component
{
    public $icon;
    public $title;

    public function __construct($icon, $title)
    {
        $this->icon = $icon;
        $this->title = $title;
    }

    public function render()
    {
        return view('components.announce.add-resource-button');
    }
}
