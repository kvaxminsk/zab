<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Composers\ProfileComposer;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
//        view()->composer('layouts.dashboard', function($view)
//        {
//            $view->with('count333','fff');
//        });
        view()->composer(['layouts.dashboard'], 'App\Composers\ProfileComposer');
//        \View::share('users2', \Auth::user());
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
