<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('school.sidebar', function($view){
            $creators = \App\Models\User::role('creator')->get();
            $view->with(compact('creators'));
        });
        Paginator::useBootstrap();
    }
}
