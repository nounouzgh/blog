<?php

namespace App\View\Composers;

use Illuminate\View\View;

class HeadComposer
{
    public function compose(View $view)
    {
        $view->with('head', view('composers.head'));
    }
}
