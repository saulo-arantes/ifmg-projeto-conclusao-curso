<?php

namespace App\Services;

use App\Entities\User;
use App\Notifications\ExceptionNotification;
use App\Notifications\ValidatorExceptionNotification;
use App\Repositories\ScheduleRepository;
use App\Validators\ScheduleValidator;
use Illuminate\Support\Facades\Notification;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

;

/**
 * Class ScheduleService
 *
 * @author  Saulo Vinícius
 * @since 04/08/2017
 * @package App\Services
 */
class ScheduleService {

	protected $repository;
	protected $validator;

	/**
	 * ScheduleService constructor.
	 *
	 * @param ScheduleRepository $repository
	 * @param ScheduleValidator $validator
	 */
	public function __construct(ScheduleRepository $repository, ScheduleValidator $validator) {
		$this->repository = $repository;
		$this->validator  = $validator;
	}

	public function store(array $data) {
		try {

			$this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);

			$schedule = $this->repository->create($data);

			return $schedule['data']['id'];

		} catch (ValidatorException $exception) {

			Notification::send(User::allAdmins(),
				new ValidatorExceptionNotification($exception->getFile(), $exception->getLine(),
					$exception->getMessageBag()->first()));

			return [
				'error'   => true,
				'message' => $exception->getMessageBag()->first()
			];
		} catch (\Exception $exception) {

			Notification::send(User::allAdmins(),
				new ExceptionNotification($exception->getFile(), $exception->getLine(),
					$exception->getMessage()));

			return [
				'error'   => true,
				'message' => 'Ocorreu um erro ao adicionar agendamento.'
			];
		}
	}

	public function update(array $data, $id) {

		unset($data['role']);

		try {

			$this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
			$this->repository->update($data, $id);

			return true;
		} catch (ValidatorException $exception) {

			Notification::send(User::allAdmins(),
				new ValidatorExceptionNotification($exception->getFile(), $exception->getLine(),
					$exception->getMessageBag()->first()));

			return [
				'error'   => true,
				'message' => $exception->getMessageBag()->first()
			];
		} catch (\Exception $exception) {

			Notification::send(User::allAdmins(),
				new ExceptionNotification($exception->getFile(), $exception->getLine(),
					$exception->getMessage()));

			return [
				'error'   => true,
				'message' => 'Ocorreu um erro ao editar o agendamento.'
			];

		}
	}


}