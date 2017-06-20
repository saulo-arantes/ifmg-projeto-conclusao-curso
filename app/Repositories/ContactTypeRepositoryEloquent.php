<?php

namespace App\Repositories;

use App\Presenters\ContactTypePresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ContactTypeRepository;
use App\Entities\ContactType;
use App\Validators\ContactTypeValidator;

/**
 * Class ContactTypeRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ContactTypeRepositoryEloquent extends BaseRepository implements ContactTypeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ContactType::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ContactTypeValidator::class;
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
        return ContactTypePresenter::class;
    }
}
