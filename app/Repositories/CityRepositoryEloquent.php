<?php

namespace App\Repositories;

use App\Entities\City;
use App\Presenters\CityPresenter;
use App\Validators\CityValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class CityRepositoryEloquent
 *
 * @author  Bruno Tomé
 * @package namespace App\Repositories;
 */
class CityRepositoryEloquent extends BaseRepository implements CityRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return City::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return CityValidator::class;
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
        return CityPresenter::class;
    }
}
