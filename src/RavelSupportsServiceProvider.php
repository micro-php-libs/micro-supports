<?php

namespace MicroPhpLibs\RavelSupports;

use Illuminate\Support\ServiceProvider;

class RavelSupportsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // php artisan vendor:publish --tag=ravel-supports
//        $this->publishes([
//            __DIR__.'/ravel-supports.php' => config_path('ravel-supports.php')
//        ], 'ravel-supports');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
//        $this->mergeConfigFrom(
//            __DIR__.'/ravel-supports.php', 'ravel-supports.php'
//        );
    }
}
