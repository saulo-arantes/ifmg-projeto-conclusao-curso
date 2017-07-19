<?php

namespace App\Providers;

use App\Repositories\AdministratorRepository;
use App\Repositories\AdministratorRepositoryEloquent;
use App\Repositories\ContactTypeRepository;
use App\Repositories\ContactTypeRepositoryEloquent;
use App\Repositories\LogRepository;
use App\Repositories\LogRepositoryEloquent;
use App\Repositories\PatientContactRepository;
use App\Repositories\PatientContactRepositoryEloquent;
use App\Repositories\PatientsRepository;
use App\Repositories\PatientsRepositoryEloquent;
use App\Repositories\StateRepository;
use App\Repositories\StateRepositoryEloquent;
use App\Repositories\UserContactRepository;
use App\Repositories\UserContactRepositoryEloquent;
use App\Repositories\UserRepository;
use App\Repositories\UserRepositoryEloquent;
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
        $this->app->bind(LogRepository::class, LogRepositoryEloquent::class);
        $this->app->bind(AdministratorRepository::class,
            AdministratorRepositoryEloquent::class);
        $this->app->bind(ContactTypeRepository::class, ContactTypeRepositoryEloquent::class);
        $this->app->bind(UserContactRepository::class, UserContactRepositoryEloquent::class);
        $this->app->bind(PatientsRepository::class, PatientsRepositoryEloquent::class);
        $this->app->bind(PatientContactRepository::class, PatientContactRepositoryEloquent::class);
        $this->app->bind(StateRepository::class, StateRepositoryEloquent::class);
        $this->app->bind(UserRepository::class, UserRepositoryEloquent::class);
        //:end-bindings:
    }
}
