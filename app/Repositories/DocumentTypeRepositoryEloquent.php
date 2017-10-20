<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\DocumentTypeRepository;
use App\Entities\DocumentType;
use App\Validators\DocumentTypeValidator;

/**
 * Class DocumentTypeRepositoryEloquent
 * @package namespace App\Repositories;
 */
class DocumentTypeRepositoryEloquent extends BaseRepository implements DocumentTypeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return DocumentType::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return DocumentTypeValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
