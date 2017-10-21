<?php

namespace App\Repositories;

use App\Entities\DocumentType;
use App\Entities\Patient;
use App\Entities\User;
use App\Presenters\DocumentTypePresenter;
use App\Validators\DocumentTypeValidator;
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
	 * @param null $id
	 *
	 * @return array
	 */
	public function getExtraData($id = null): array
	{
		$extraData['middleware']    = User::getUserMiddleware();
		$extraData['documentTypes'] = DocumentType::all();
		$extraData['patients'] = Patient::all();

		return $extraData;
	}
}
