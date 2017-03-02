<?php

namespace CrowdProperty\ModulrHmacPhpClient;

use Illuminate\Support\ServiceProvider;

class ModulrServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/Config/modulr.php' => config_path('modulr.php'),
        ]);
        \App::bind('modulr', function()
        {
            return new Modulr();
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

    }
}
