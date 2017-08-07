<?php

namespace App\Http\Controllers;

use App\Entities\State;
use App\Repositories\StateRepository;
use App\Validators\StateValidator;
use Illuminate\Support\Facades\Log;

/**
 * Class StatesController
 *
 * @author  Bruno Tomé
 * @package App\Http\Controllers
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

    /**
     * Get all cities of a given state.
     *
     * @param $stateID
     *
     * @return string
     */
    public function getCities($stateID)
    {
        Log::alert($stateID);
        $cities = State::find($stateID)->cities;
        $options = '';
        foreach ($cities as $city) {
            $options .= '<option value="' . $city['id'] . '">' . $city['name'] . '</option>';
        }

        return $options;
    }
}
