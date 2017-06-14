<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
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
        $this->app->bind(\App\Repositories\LogRepository::class, \App\Repositories\LogRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\AdministratorRepository::class, \App\Repositories\AdministratorRepositoryEloquent::class);
        //:end-bindings:
    }
}
