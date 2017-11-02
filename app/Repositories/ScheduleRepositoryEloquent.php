<?php

namespace App\Repositories;

use App\Entities\Doctor;
use App\Entities\Patient;
use App\Entities\Schedule;
use App\Entities\User;
use App\Presenters\SchedulePresenter;
use App\Validators\ScheduleValidator;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class ScheduleRepositoryEloquent
 *
 * @author  Saulo Vinícius
 * @package App\Repositories
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

	/**
	 * @param null $id
	 *
	 * @return mixed
	 */
	public function getExtraData($id = null)
	{
		$extraData['patients']           = Patient::all();
		$extraData['schedules']          = Schedule::all();
		$extraData['doctors']            = Doctor::with('user')->get();
		$extraData['middleware']         = User::getUserMiddleware();
		$extraData['schedules_doctors']  = Schedule::all('doctor_id');
		$extraData['schedules_patients'] = Schedule::all('patient_id');

		return $extraData;
	}

	/**
	 * Return events by date range.
	 *
	 * @param Request $request
	 *
	 * @return array
	 */
	public function getSchedulesForCalendar(Request $request)
	{
		$start = date('Y-m-d H:i:s', $request->get('start'));
		$end   = date('Y-m-d H:i:s', $request->get('end'));

		try {
			$schedules = Schedule::with(['patient'])
			                     ->where('start_at', '>=', $start)
			                     ->where('finish_at', '<=', $end)
			                     ->get()
			                     ->toArray();
		} catch (\Exception $e) {
			$schedules = [];
		}

		return $schedules;
	}
}