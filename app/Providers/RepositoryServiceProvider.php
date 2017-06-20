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
        $this->app->bind(\App\Repositories\AdministratorRepository::class,
            \App\Repositories\AdministratorRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\ContactTypeRepository::class, \App\Repositories\ContactTypeRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\UserContactRepository::class, \App\Repositories\UserContactRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PatientsRepository::class, \App\Repositories\PatientsRepositoryEloquent::class);
        $this->app->bind(\App\Repositories\PatientContactRepository::class, \App\Repositories\PatientContactRepositoryEloquent::class);
        //:end-bindings:
    }
}
