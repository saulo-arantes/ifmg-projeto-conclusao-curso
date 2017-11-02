<?php

namespace App\Repositories;

use App\Entities\State;
use App\Presenters\StatePresenter;
use App\Validators\StateValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class StateRepositoryEloquent
 *
 * @author  Saulo Vinícius
 * @package namespace App\Repositories;
 */
class StateRepositoryEloquent extends BaseRepository implements StateRepository
{
	/**
	 * Specify Model class name
	 *
	 * @return string
	 */
	public function model()
	{
		return State::class;
	}

	/**
	 * Specify Validator class name
	 *
	 * @return mixed
	 */
	public function validator()
	{

		return StateValidator::class;
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
		return StatePresenter::class;
	}
}
