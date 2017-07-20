<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\DoctorPatientRepository;
use App\Entities\DoctorPatient;
use App\Validators\DoctorPatientValidator;

/**
 * Class DoctorPatientRepositoryEloquent
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
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
