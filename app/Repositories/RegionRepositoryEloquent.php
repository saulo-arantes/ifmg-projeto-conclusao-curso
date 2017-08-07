<?php

namespace App\Repositories;

use App\Entities\Region;
use App\Presenters\RegionPresenter;
use App\Validators\RegionValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class RegionRepositoryEloquent
 *
 * @author Saulo Vinícius
 * @package namespace App\Repositories;
 */
class RegionRepositoryEloquent extends BaseRepository implements RegionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Region::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return RegionValidator::class;
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
        return RegionPresenter::class;
    }
}
