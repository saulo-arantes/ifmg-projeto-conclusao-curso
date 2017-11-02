<?php

namespace App\Repositories;

use App\Entities\Secretary;
use App\Presenters\SecretaryPresenter;
use App\Validators\SecretaryValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class SecretaryRepositoryEloquent
 * @package namespace App\Repositories;
 */
class SecretaryRepositoryEloquent extends BaseRepository implements SecretaryRepository
{
	/**
	 * Specify Model class name
	 *
	 * @return string
	 */
	public function model()
	{
		return Secretary::class;
	}

	/**
	 * Specify Validator class name
	 *
	 * @return mixed
	 */
	public function validator()
	{

		return SecretaryValidator::class;
	}


	/**
	 * Boot up the repository, pushing criteria
	 */
	public function boot()
	{
		$this->pushCriteria(app(RequestCriteria::class));
	}

	public function presenter()
	{
		return SecretaryPresenter::class;
	}
}
