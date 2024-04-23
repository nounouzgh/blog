<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CardAnnounceSalle extends Component
{
    public $salle;
    public $progressPercentage;
    public $timeFrame;

    public function __construct($salle, $progressPercentage, $timeFrame)
    {
        $this->salle = $salle;
        $this->progressPercentage = $progressPercentage;
        $this->timeFrame = $timeFrame;
    }

    public function render()
    {
        return view('components.announce.cardAnnouce.card-announce-salle');
    }
}
