<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CardAnnounceExpenses extends Component
{
    public $totalExpenses;
    public $progressPercentage;
    public $timeFrame;

    public function __construct($totalExpenses, $progressPercentage, $timeFrame)
    {
        $this->totalExpenses = $totalExpenses;
        $this->progressPercentage = $progressPercentage;
        $this->timeFrame = $timeFrame;
    }

    public function render()
    {
        return view('components.announce.cardAnnouce.card-announce-expenses');
    }
}
