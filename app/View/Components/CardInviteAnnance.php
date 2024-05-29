<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CardInviteAnnance extends Component
{
    public $invitation; // Declare the $invitation variable

    public function __construct($invitation)
    {
        $this->invitation = $invitation; // Initialize the $invitation variable
    }

    public function render()
    {
        return view('components.announce.cardAnnouce.Card_Invite_Annance');
    }
}
