<?php

namespace App\Providers;

use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\View\Components\CardAnnounceIncome;
use App\Auth\Guards\AdminGuard;
use Illuminate\Support\Facades\Auth;
use App\View\Components\DashboardLayout;
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
        // Extend the authentication system with a custom 'admin' guard
        /*
        Auth::extend('admin', function ($app, $name, array $config) {
            return new AdminGuard(
                $name,
                Auth::createUserProvider($config['provider']),
                $app['session.store']
            );
        });*/
        // Bind the AddResourceButton component to the 'add-resource-button' view
        View::composer('component.announce.add-resource-button', 'App\View\Components\announce\AddResourceButton');

        // Bind the OnlineItem component to the 'components.online-item' view
        View::composer('component.announce.itemonline', 'App\View\Components\announce\itemonline');
   
        View::composer('component.announce.itemcostomers', 'App\View\Components\announce\itemcostomers');

        View::composer('component.announce.itemoffline', 'App\View\Components\announce\itemoffline');
   
        View::composer('component.announce.update', 'App\View\Components\announce\update');
        
        View::composer('component.announce.profile', 'App\View\Components\announce\profile');
   
        View::composer('component.announce.ListAnnounce', 'App\View\Components\announce\ListAnnounce');
   
        View::composer('component.announce.ListAnnounce', 'App\View\Components\announce\ListAnnounce');
        View::composer('component.sidebar', 'App\View\Components\sidebar');
     
   }
}
