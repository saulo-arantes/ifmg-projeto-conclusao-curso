<?php

namespace App\Services;

use App\Entities\Schedule;
use App\Entities\User;
use App\Notifications\ExceptionNotification;
use App\Notifications\ValidatorExceptionNotification;
use App\Repositories\ScheduleRepository;
use App\Validators\ScheduleValidator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Route;
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

		$startAt  = Carbon::createFromFormat('d/m/Y H:i', $data['start_at']);
		$finishAt = Carbon::createFromFormat('d/m/Y H:i', $data['finish_at']);

		$data['start_at']  = $startAt;
		$data['finish_at'] = $finishAt;

		if ($data['finish_at'] < $data['start_at']) {
			return [
				'error'   => true,
				'message' => 'Opeação inválida. 
				A data de Término não pode ser menor que a data de Início.'
			];
		}

		$data['type'] = session('type');

		$schedules = Schedule::all();

		foreach ($schedules as $schedule) {
			if ($data['doctor_id'] = $schedule['doctor_id']) {
				if ($data['start_at'] >= $schedule['start_at'] && $data['start_at'] < $schedule['finish_at']) {
					if ($data['type'] == 0) {
						if ($data['status'] != Schedule::ACCOMPLISHED && $data['status'] != Schedule::CANCELED) {
							if (User::getUserMiddleware() == User::DOCTOR) {
								return [
									'error'   => true,
									'message' => 'Opeação inválida. 
							Você já possui um compromisso neste horário.'
								];
							} else {
								return [
									'error'   => true,
									'message' => 'Opeação inválida. 
								Já existe um compromisso neste horário para esse médico.'
								];
							}
						}
					} elseif ($data['type'] == 1) {
						if (User::getUserMiddleware() == User::DOCTOR) {
							return [
								'error'   => true,
								'message' => 'Opeação inválida. 
							Você já possui um compromisso neste horário.'
							];
						} else {
							return [
								'error'   => true,
								'message' => 'Opeação inválida. 
								Já existe um compromisso neste horário para esse médico.'
							];
						}
					}
				}
			}
		}

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

		$startAt  = Carbon::createFromFormat('d/m/Y H:i', $data['start_at']);
		$finishAt = Carbon::createFromFormat('d/m/Y H:i', $data['finish_at']);

		$data['start_at']  = $startAt;
		$data['finish_at'] = $finishAt;

		if ($data['finish_at'] < $data['start_at']) {
			return [
				'error'   => true,
				'message' => 'Opeação inválida. 
				A data de Término não pode ser menor que a data de Início.'
			];
		}

		$data['type'] = session('type');

		$schedules = Schedule::all();

		foreach ($schedules as $schedule) {
			if ($data['doctor_id'] = $schedule['doctor_id']) {
				if ($data['start_at'] >= $schedule['start_at'] && $data['start_at'] < $schedule['finish_at']) {
					if ($data['type'] == 0) {
						if ($data['status'] != Schedule::ACCOMPLISHED && $data['status'] != Schedule::CANCELED) {
							if (User::getUserMiddleware() == User::DOCTOR) {
								return [
									'error'   => true,
									'message' => 'Opeação inválida. 
							Você já possui um compromisso neste horário.'
								];
							} else {
								return [
									'error'   => true,
									'message' => 'Opeação inválida. 
								Já existe um compromisso neste horário para esse médico.'
								];
							}
						}
					} elseif ($data['type'] == 1) {
						if (User::getUserMiddleware() == User::DOCTOR) {
							return [
								'error'   => true,
								'message' => 'Opeação inválida. 
							Você já possui um compromisso neste horário.'
							];
						} else {
							return [
								'error'   => true,
								'message' => 'Opeação inválida. 
								Já existe um compromisso neste horário para esse médico.'
							];
						}
					}
				}
			}
		}

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