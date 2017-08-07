<?php

namespace App\Repositories;

use App\Entities\Doctor;
use App\Validators\DoctorValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class DoctorRepositoryEloquent
 * @package namespace App\Repositories;
 */
class DoctorRepositoryEloquent extends BaseRepository implements DoctorRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Doctor::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return DoctorValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
