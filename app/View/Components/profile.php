<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Profile extends Component
{
    /**
     * The name of the user.
     *
     * @var string
     */
    public $name;

    /**
     * The role of the user.
     *
     * @var string
     */
    public $role;

    /**
     * The profile number of the user.
     *
     * @var string
     */
    public $image;

    /**
     * Create a new component instance.
     *
     * @param string $name
     * @param string $role
     * @param int $profileNumber
     */
    public function __construct($name, $role, $image)
    {
        $this->name = $name;
        $this->role = $role;
        $this->image = $image;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render(): View|Closure|string
    {
        return view('components.announce.profile');
    }
}
