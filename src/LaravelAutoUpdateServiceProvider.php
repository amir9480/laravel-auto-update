<?php

namespace LaravelAutoUpdate;

use Illuminate\Support\ServiceProvider;
use LaravelAutoUpdate\Commands\CheckCommand;
use LaravelAutoUpdate\Commands\UpdateCommand;

class LaravelAutoUpdateServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'laravel-auto-update');
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-auto-update');
        $this->loadRoutesFrom(__DIR__.'/../routes/routes.php');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/config.php' => config_path('laravelautoupdate.php'),
            ], 'config');
            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/laravel-auto-update'),
            ], 'views');

            $this->commands([
                CheckCommand::class,
                UpdateCommand::class
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'laravel-auto-update');

        $this->app->singleton('laravel-auto-update', function () {
            return new LaravelAutoUpdate;
        });
    }
}
