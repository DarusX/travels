<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use App\Timezone;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('components.breadcrumb', 'breadcrumb');
        Blade::component('components.pending', 'pending');
        Blade::component('components.working', 'working');
        Blade::component('components.done', 'done');

        try {
            View::share('timezones', Timezone::all());
        } catch (\Exception $e) {

        }
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
