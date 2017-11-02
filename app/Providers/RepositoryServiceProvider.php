<?php

namespace App\Providers;

use App\Repositories\AdministratorRepository;
use App\Repositories\AdministratorRepositoryEloquent;
use App\Repositories\ContactTypeRepository;
use App\Repositories\ContactTypeRepositoryEloquent;
use App\Repositories\DoctorPatientRepository;
use App\Repositories\DoctorPatientRepositoryEloquent;
use App\Repositories\DoctorRepository;
use App\Repositories\DoctorRepositoryEloquent;
use App\Repositories\DocumentTypeRepository;
use App\Repositories\DocumentTypeRepositoryEloquent;
use App\Repositories\PatientContactRepository;
use App\Repositories\PatientContactRepositoryEloquent;
use App\Repositories\PatientsRepository;
use App\Repositories\PatientsRepositoryEloquent;
use App\Repositories\ScheduleRepository;
use App\Repositories\ScheduleRepositoryEloquent;
use App\Repositories\SecretaryRepository;
use App\Repositories\SecretaryRepositoryEloquent;
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
		$this->app->bind(AdministratorRepository::class,
			AdministratorRepositoryEloquent::class);
		$this->app->bind(ContactTypeRepository::class, ContactTypeRepositoryEloquent::class);
		$this->app->bind(UserContactRepository::class, UserContactRepositoryEloquent::class);
		$this->app->bind(PatientsRepository::class, PatientsRepositoryEloquent::class);
		$this->app->bind(PatientContactRepository::class, PatientContactRepositoryEloquent::class);
		$this->app->bind(StateRepository::class, StateRepositoryEloquent::class);
		$this->app->bind(UserRepository::class, UserRepositoryEloquent::class);
		$this->app->bind(ScheduleRepository::class, ScheduleRepositoryEloquent::class);
		$this->app->bind(DoctorRepository::class, DoctorRepositoryEloquent::class);
		$this->app->bind(DoctorPatientRepository::class, DoctorPatientRepositoryEloquent::class);
		$this->app->bind(DocumentTypeRepository::class, DocumentTypeRepositoryEloquent::class);
		$this->app->bind(SecretaryRepository::class, SecretaryRepositoryEloquent::class);
		//:end-bindings:
	}
}
