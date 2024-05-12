<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Pagination\Paginator;

class Pagination extends Component
{
    public $paginator;

    /**
     * Create a new component instance.
     *
     * @param  mixed  $paginator
     * @return void
     */
    public function __construct($paginator)
    {
        $this->paginator = $paginator;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.pagination');
    }
}
