<?php

namespace App\Repositories;

use App\Presenters\UserContactPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\UserContactRepository;
use App\Entities\UserContact;
use App\Validators\UserContactValidator;

/**
 * Class UserContactRepositoryEloquent
 * @package namespace App\Repositories;
 */
class UserContactRepositoryEloquent extends BaseRepository implements UserContactRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return UserContact::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return UserContactValidator::class;
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
        return UserContactPresenter::class;
    }
}
