<?php

namespace App\Providers;

use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\View\Components\AddResourceButton;
use App\View\Components\OnlineItem; // Import the OnlineItem component

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->bind(UserRepository::class, UserRepository::class); // Replace with your UserRepository implementation
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Bind the HeadComposer to the 'layouts.app' view
       // View::composer('layouts.app', 'App\View\Composers\HeadComposer');

        // Bind the AddResourceButton component to the 'add-resource-button' view
        View::composer('component.announce.add-resource-button', 'App\View\Components\announce\AddResourceButton');

        // Bind the OnlineItem component to the 'components.online-item' view
        View::composer('component.announce.itemonline', 'App\View\Components\announce\itemonline');
   
        View::composer('component.announce.itemcostomers', 'App\View\Components\announce\itemcostomers');

        View::composer('component.announce.itemoffline', 'App\View\Components\announce\itemoffline');
   
    }
}
