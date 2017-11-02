<?php

namespace App\Repositories;

use App\Entities\DocumentType;
use App\Entities\Patient;
use App\Entities\User;
use App\Presenters\DocumentTypePresenter;
use App\Validators\DocumentTypeValidator;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

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

	public function presenter()
	{
		return DocumentTypePresenter::class;
	}

	/**
	 * Get extra data to use in views
	 */
	public function getExtraData()
	{
		$patient                    = new Patient();
		$extraData['patients']      = Patient::all();
		$extraData['documentTypes'] = DocumentType::all();
		$extraData['middleware']    = User::getUserMiddleware();
		$extraData['doctor']        = Auth::user()->name;
		if (!empty(session('patient_id'))) {
			$extraData['patient'] = $patient->find(session('patient_id'))->name;
		}

		return $extraData;
	}
}
