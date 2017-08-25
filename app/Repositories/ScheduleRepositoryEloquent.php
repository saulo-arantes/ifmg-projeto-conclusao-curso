<?php

namespace App\Repositories;

use App\Entities\Doctor;
use App\Entities\Patient;
use App\Entities\Schedule;
use App\Entities\User;
use App\Presenters\SchedulePresenter;
use App\Validators\ScheduleValidator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class ScheduleRepositoryEloquent
 *
 * @author Saulo Vinícius
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

    /**
     * This method return suppliers and vaccines of the stock
     *
     * @param null $id
     *
     * @return mixed
     */
    public function getExtraData($id = null)
    {
	    $extraData['patients'] = Patient::all();
	    $extraData['doctors'] = Doctor::all();
	    $extraData['middleware'] = User::getUserMiddleware();

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
        $end = date('Y-m-d H:i:s', $request->get('end'));

        try {
            $schedules = Schedule::with(['patient'])->where('start_at', '>=', $start)->where('finish_at', '<=',
                $end)->where('unity_id',
                Auth::user()->last_unity_id)->get()->toArray();

        } catch (\Exception $e) {
            $schedules = [];
        }

        return $schedules;
    }
}