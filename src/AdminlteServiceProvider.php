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
      if(!file_exists(config_path('adminlte.php'))){
        $this->publishes([
          __DIR__.'/../config/admin_lte.php' => config_path('admin_lte.php')
        ]);
      }

      $this->publishes([
        __DIR__.'/../lang' => resource_path('lang'),
        __DIR__.'/../resources/views' => resource_path('views'),
        __DIR__.'/../public' => public_path(''),
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
