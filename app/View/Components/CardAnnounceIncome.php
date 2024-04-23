<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CardAnnounceIncome extends Component
{
    public $totalIncome;
    public $progressPercentage;
    public $timeFrame;

    public function __construct($totalIncome, $progressPercentage, $timeFrame)
    {
        $this->totalIncome = $totalIncome;
        $this->progressPercentage = $progressPercentage;
        $this->timeFrame = $timeFrame;
    }

    public function render()
    {
        return view('components.announce.cardAnnouce.card-announce-income');
    }
}
