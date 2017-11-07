<?php

namespace ahyadessam\AdminLTE;

use Illuminate\Support\ServiceProvider;

class AdminLTEServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
      $this->publishes([
        __DIR__.'../config/adminlte.php' => config_path('adminlte.php'),
        __DIR__.'../lang' => resource_path('lang'),
        __DIR__.'../resources/views/adminlte_layout' => resource_path('views'),
        __DIR__.'../public' => public_path(''),
      ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
      $this->app->bind('ahyadessam\AdminLTE', function ($app) {
        return new HelpSpot\API($app->make('AdminLTE'));
      });
    }

}
