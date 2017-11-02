<?php

namespace App\Http\Controllers;

use App\Repositories\CityRepository;
use App\Validators\CityValidator;

/**
 * Class AuditsController
 *
 * @author Saulo Vinícius
 * @since 07/06/2017
 * @package App\Http\Controllers
 */
class CitiesController extends Controller
{

	/**
	 * @var CityRepository
	 */
	protected $repository;

	/**
	 * @var CityValidator
	 */
	protected $validator;

	public function __construct(CityRepository $repository, CityValidator $validator)
	{
		$this->repository = $repository;
		$this->validator  = $validator;
	}
}
