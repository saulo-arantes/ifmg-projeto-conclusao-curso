<?php

namespace App\Repositories;

use App\Entities\DoctorPatient;
use App\Presenters\DoctorPatientPresenter;
use App\Validators\DoctorPatientValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class DoctorPatientRepositoryEloquent
 *
 * @author Saulo Vinícius
 * @package namespace App\Repositories;
 */
class DoctorPatientRepositoryEloquent extends BaseRepository implements DoctorPatientRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return DoctorPatient::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return DoctorPatientValidator::class;
    }

    /**
     * Specify Presenter class name
     *
     * @return string
     */
    public function presenter()
    {
        return DoctorPatientPresenter::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
