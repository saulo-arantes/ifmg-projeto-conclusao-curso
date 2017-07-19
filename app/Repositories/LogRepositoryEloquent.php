<?php

namespace App\Repositories;

use App\Entities\Log;
use App\Presenters\LogPresenter;
use App\Validators\LogValidator;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class LogRepositoryEloquent
 *
 * @author  Bruno Tomé
 * @package namespace TARS\Repositories;
 */
class LogRepositoryEloquent extends BaseRepository implements LogRepository {

	/**
	 * Create a log of ERROR type.
	 *
	 * @param \Exception $e
	 */
	public function error(\Exception $e) {
		Log::create([
			'type'        => 0,
			'user_id'     => Auth::user()->id,
			'description' => 'Arquivo => ' . $e->getFile() . '<br><br>Linha => ' . $e->getLine() . '<br><br> Exception => ' . $e->getMessage()
		]);
	}

	/**
	 * Create a log of VALIDATOR_EXCEPTION type.
	 *
	 * @param ValidatorException $e
	 */
	public function validatorException(ValidatorException $e) {
		Log::create([
			'type'        => 0,
			'user_id'     => Auth::user()->id,
			'description' => 'Arquivo => ' . $e->getFile() . '<br><br>Linha => ' . $e->getLine() . '<br><br> Exception => ' . $e->getMessageBag()->first()
		]);
	}

	/**
	 * Create a log of ALERT type.
	 *
	 * @param \Exception $e
	 */
	public function alert(\Exception $e) {
		Log::create([
			'type'        => 1,
			'user_id'     => Auth::user()->id,
			'description' => 'Arquivo => ' . $e->getFile() . '<br><br>Linha => ' . $e->getLine() . '<br><br> Exception => ' . $e->getMessage()
		]);
	}

	/**
	 * Create a log of INFO type.
	 *
	 * @param string $description
	 */
	public function info($description) {
		Log::create([
			'type'        => 2,
			'user_id'     => Auth::user()->id,
			'description' => $description
		]);
	}

	/**
	 * Create a log of DENIED type.
	 */
	public function denied() {
		Log::create([
			'type'        => 3,
			'user_id'     => Auth::user()->id,
			'description' => 'URL => ' . \request()->getRequestUri(),
		]);
	}

	/**
	 * Specify Model class name
	 *
	 * @return string
	 */
	public function model() {
		return Log::class;
	}

	/**
	 * Specify Validator class name
	 *
	 * @return mixed
	 */
	public function validator() {
		return LogValidator::class;
	}

	/**
	 * Boot up the repository, pushing criteria
	 */
	public function boot() {
		$this->pushCriteria(app(RequestCriteria::class));
	}

	public function presenter() {
		return LogPresenter::class;
	}

	/**
	 * Set the visualized attribute to true for all non visualized messages.
	 */
	public function visualizeAll() {
		foreach (Log::where('visualized', 0)->get() as $log) {
			$log->update(['visualized' => 1]);
		}
	}

	public function markAsSeen($id) {
		Log::find($id)->update(['visualized' => 1]);
	}
}
