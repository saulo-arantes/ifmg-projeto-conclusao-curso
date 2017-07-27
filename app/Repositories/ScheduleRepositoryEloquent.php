<?php

namespace App\Repositories;

use App\Entities\Schedule;
use App\Presenters\SchedulePresenter;
use App\Validators\ScheduleValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class ScheduleRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ScheduleRepositoryEloquent extends BaseRepository implements ScheduleRepository
{
	/**
	 * Specify Model class name
	 *
	 * @return string
	 */
	public function model()
	{

		return Schedule::class;
	}

	/**
	 * Specify Validator class name
	 *
	 * @return mixed
	 */
	public function validator()
	{

		return ScheduleValidator::class;
	}


	/**
	 * Boot up the repository, pushing criteria
	 */
	public function boot()
	{
		$this->pushCriteria(app(RequestCriteria::class));
	}

	/**
	 * Specify Presenter class name
	 *
	 * @return string
	 */
	public function presenter()
	{

		return SchedulePresenter::class;
	}
}
