<?php

namespace IUGOsds\SherLaravel;

use Illuminate\Support\ServiceProvider;

class SherLaravelServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/sherlaravel.php', 'sherlaravel');

        // Register the service the package provides.
        $this->app->singleton('sherlaravel', function ($app) {
            return new SherLaravel;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['sherlaravel'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/sherlaravel.php' => config_path('sherlaravel.php'),
        ], 'sherlaravel-config');

        // Registering package commands.
        // $this->commands([]);
    }
}
