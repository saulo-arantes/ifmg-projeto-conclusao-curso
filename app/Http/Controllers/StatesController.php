<?php

namespace App\Http\Controllers;

use App\Repositories\StateRepository;
use App\Validators\StateValidator;

/**
 * Class StatesController
 *
 * @author  Bruno Tomé
 * @package TARS\Http\Controllers
 */
class StatesController extends Controller
{

    /**
     * @var StateRepository
     */
    protected $repository;

    /**
     * @var StateValidator
     */
    protected $validator;

    public function __construct(StateRepository $repository, StateValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }
}
