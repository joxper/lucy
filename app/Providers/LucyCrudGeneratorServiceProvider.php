<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class LucyCrudGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands(
            'App\Lucy\CrudGenerator\Commands\CrudLangCommand',
            'App\Lucy\CrudGenerator\Commands\CrudViewCommand',
            'App\Lucy\CrudGenerator\Commands\CrudModelCommand',
            'App\Lucy\CrudGenerator\Commands\CrudRouteCommand',
            'App\Lucy\CrudGenerator\Commands\CrudRequestCommand',
            'App\Lucy\CrudGenerator\Commands\CrudMigrationCommand',
            'App\Lucy\CrudGenerator\Commands\CrudControllerCommand'
        );
    }
}
