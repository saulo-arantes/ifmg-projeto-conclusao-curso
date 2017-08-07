<?php

namespace App\Repositories;

use App\Entities\ContactType;
use App\Presenters\ContactTypePresenter;
use App\Validators\ContactTypeValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class ContactTypeRepositoryEloquent
 *
 * @author Saulo Vinícius
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
