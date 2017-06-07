<?php

namespace App\Http\Controllers;

use App\Repositories\RegionRepository;
use App\Validators\RegionValidator;


class RegionsController extends Controller
{

    /**
     * @var RegionRepository
     */
    protected $repository;

    /**
     * @var RegionValidator
     */
    protected $validator;

    public function __construct(RegionRepository $repository, RegionValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }
}
