<?php

namespace MicroPhpLibs\MicroSupports;

use Illuminate\Support\ServiceProvider;

class MicroSupportsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // php artisan vendor:publish --tag=micro-supports
//        $this->publishes([
//            __DIR__.'/micro-supports.php' => config_path('micro-supports.php')
//        ], 'micro-supports');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
//        $this->mergeConfigFrom(
//            __DIR__.'/micro-supports.php', 'micro-supports.php'
//        );
    }
}
