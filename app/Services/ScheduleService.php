<?php
/**
 * Created by PhpStorm.
 * User: saulo
 * Date: 04/08/17
 * Time: 09:26
 */

namespace App\Services;


use App\Http\Requests\ScheduleCreateRequest;
use App\Repositories\LogRepository;
use App\Repositories\ScheduleRepository;
use App\Validators\ScheduleValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class ScheduleService
 *
 * @author  Saulo Vinícius
 * @since 04/08/2017
 * @package App\Services
 */
class ScheduleService {

	/**
	 * @var ScheduleRepository
	 */
	protected $repository;

	/**
	 * @var ScheduleValidator
	 */
	protected $validator;

	/**
	 * @var LogRepository
	 */
	protected $log;

	/**
	 * ScheduleService constructor.
	 *
	 * @param ScheduleRepository $repository
	 * @param ScheduleValidator $validator
	 * @param LogRepository $log
	 */
	public function __construct(ScheduleRepository $repository, ScheduleValidator $validator, LogRepository $log) {
		$this->repository = $repository;
		$this->validator  = $validator;
		$this->log        = $log;
	}

	/**
	 *
	 * @param ScheduleCreateRequest $request
	 *
	 * @return array
	 */
	public function store(ScheduleCreateRequest $request) {
		try {

			$data = $request->all();;

			$this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);

			$schedule = $this->repository->create($data);

			return $schedule['data']['id'];

		} catch (ValidatorException $e) {
			$this->log->validatorException($e);

			return [
				'error'   => true,
				'message' => $e->getMessageBag()->first()
			];
		} catch (\Exception $e) {
			$this->log->error($e);

			return [
				'error'   => true,
				'message' => 'Ocorreu um erro ao adicionar agendamento.'
			];
		}
	}

	public function update(ScheduleCreateRequest $request, $id) {
		try {
			$data = $request->except('level');

			$this->validator->setId($id);
			$this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
			$this->repository->update($data, $id);

			return true;
		} catch (ValidatorException $e) {
			$this->log->validatorException($e);

			return [
				'error'   => true,
				'message' => $e->getMessageBag()->first()
			];
		} catch (ModelNotFoundException $e) {
			$this->log->error($e);

			return [
				'error'   => true,
				'message' => 'Agendamento não encontrado.'
			];

		} catch (\Exception $e) {
			$this->log->error($e);

			return [
				'error'   => true,
				'message' => 'Ocorreu um erro ao editar o agendamento.'
			];

		}
	}


}