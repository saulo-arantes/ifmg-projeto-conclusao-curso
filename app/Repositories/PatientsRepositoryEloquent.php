<?php

namespace App\Repositories;

use App\Entities\Patients;
use App\Entities\State;
use App\Presenters\PatientsPresenter;
use App\Validators\PatientsValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class PatientsRepositoryEloquent
 * @package namespace App\Repositories;
 */
class PatientsRepositoryEloquent extends BaseRepository implements PatientsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Patients::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return PatientsValidator::class;
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
        return PatientsPresenter::class;
    }

    /**
     * This method return extra arrays to use in views.
     *
     * @param $id
     *
     * @return array
     */
    public function getExtraData($id = null): array
    {
        $extraData['states'] = State::all();
        if (!empty($id)) {
            $data = $this->find($id);
            if (!empty($data['data']['city']['data']['id'])) {
                $extraData['cities'] = State::find($data['data']['city']['data']['state']['id'])->cities;
            }
            if (!empty($data['data']['naturalness']['data']['id'])) {
                $extraData['naturalness'] = State::find($data['data']['naturalness']['data']['state']['id'])->cities;
            }
        }
        return $extraData;
    }
}
