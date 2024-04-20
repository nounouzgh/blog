<?php

namespace App\View\Components;

use Illuminate\View\Component;

class itemcostomers extends Component
{
    /**
     * The icon for the online item.
     *
     * @var string
     */
    public $icon;

    /**
     * The title for the online item.
     *
     * @var string
     */
    public $title;

    /**
     * The subtitle for the online item.
     *
     * @var string
     */
    public $subtitle;

    /**
     * The percentage for the online item.
     *
     * @var string
     */
    public $percentage;

    /**
     * The count for the online item.
     *
     * @var string
     */
    public $count;

    /**
     * Create a new component instance.
     *
     * @param  string  $icon
     * @param  string  $title
     * @param  string  $subtitle
     * @param  string  $percentage
     * @param  string  $count
     * @return void
     */
    public function __construct($icon, $title, $subtitle, $percentage, $count)
    {
        $this->icon = $icon;
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->percentage = $percentage;
        $this->count = $count;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.announce.itemcostomers');
    }
}
