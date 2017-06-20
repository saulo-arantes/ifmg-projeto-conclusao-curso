<?php

namespace App\Repositories;

use App\Presenters\PatientsPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PatientsRepository;
use App\Entities\Patients;
use App\Validators\PatientsValidator;

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
}
