<?php

namespace Gldrenthe89\NovaCalculatedField;

use Illuminate\Support\Facades\Route;
use Laravel\Nova\Nova;
use Laravel\Nova\Events\ServingNova;
use Illuminate\Support\ServiceProvider;

class NovaCalculatedFieldServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Nova::serving(function (ServingNova $event) {
            Nova::script('nova-calculated-field', __DIR__.'/../dist/js/field.js');
            Nova::style('nova-calculated-field', __DIR__.'/../dist/css/field.css');
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->routesAreCached()) {
            return;
        }

        Route::middleware(['nova'])
            ->namespace('Gldrenthe89\NovaCalculatedField\Http\Controllers')
            ->prefix('gldrenthe89/nova-calculated-field')
            ->group(__DIR__.'/../routes/api.php');
    }
}
