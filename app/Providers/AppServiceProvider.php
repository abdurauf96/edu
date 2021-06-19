<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        view()->composer('dashboard', function($view){
            $num_students=\App\Models\Student::all()->count();
            $num_courses=\App\Models\Course::all()->count();
            $num_groups=\App\Models\Group::all()->count();
            $num_teachers=\App\Models\Teacher::all()->count();
            $view->with(compact('num_students', 'num_courses', 'num_groups', 'num_teachers'));
        });
    }
}
