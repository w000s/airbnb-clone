<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ExtendResourceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // $registrar = new \Illuminate\Routing\ResourceRegistrar($this->app['router']);

        // $this->app->bind('Illuminate\Routing\ResourceRegistrar', function () use ($registrar) {
        //     return $registrar;
        // });
    }
}
