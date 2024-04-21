<?php


    namespace App\View\Components;
    
    use Closure;
    use Illuminate\Contracts\View\View;
    use Illuminate\View\Component;
    
    class ListAnnounce  extends Component
    {
        /**
         * The resources to display.
         *
         * @var array
         */
        public $resources;
    
        /**
         * Create a new component instance.
         *
         * @param  array  $resources
         * @return void
         */
        public function __construct($resources)
        {
            $this->resources = $resources;
        }
    
        /**
         * Get the view / contents that represent the component.
         *
         * @return \Illuminate\Contracts\View\View|\Closure|string
         */
        public function render(): View|Closure|string
        {
            return view('components.announce.ListAnnounce');
        }
    }
    