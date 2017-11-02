<?php

namespace App\Services;

use App\Entities\Doctor;
use App\Entities\Schedule;
use App\Entities\User;
use App\Notifications\ExceptionNotification;
use App\Notifications\ValidatorExceptionNotification;
use App\Repositories\ScheduleRepository;
use App\Validators\ScheduleValidator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;


/**
 * Class ScheduleService
 *
 * @author  Saulo Vinícius
 * @since 04/08/2017
 * @package App\Services
 */
class ScheduleService
{

	protected $repository;
	protected $validator;

	/**
	 * ScheduleService constructor.
	 *
	 * @param ScheduleRepository $repository
	 * @param ScheduleValidator $validator
	 */
	public function __construct(ScheduleRepository $repository, ScheduleValidator $validator)
	{
		$this->repository = $repository;
		$this->validator  = $validator;
	}

	public function store(array $data)
	{

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

		if ($data['type'] == 1 && User::isDoctor()) {
			$doctors = Doctor::all();
			foreach ($doctors as $doctor) {
				if (Auth::id() == $doctor['user_id']) {
					$data['doctor_id'] = $doctor['id'];
				}
			}
		}

		if (empty($data['doctor_id'])) {
			return [
				'error'   => true,
				'message' => 'Opeação inválida. 
				Selecione um médico.'
			];
		}

		if ($data['type'] == 0) {
			if (empty($data['doctor_id'])) {
				return [
					'error'   => true,
					'message' => 'Opeação inválida. 
					Selecione um médico.'
				];
			} elseif (empty($data['patient_id'])) {
				return [
					'error'   => true,
					'message' => 'Opeação inválida. 
					Selecione um paciente.'
				];
			}
		}

		$schedules = Schedule::all();

		if ($data['type'] == 0) {
			foreach ($schedules as $schedule) {
				if ($data['doctor_id'] == $schedule['doctor_id']) {
					if (($data['start_at'] >= $schedule['start_at'] && $data['start_at'] < $schedule['finish_at']) ||
					    ($data['start_at'] <= $schedule['start_at'] && $schedule['start_at'] <= $data['finish_at']) ||
					    ($data['start_at'] < $schedule['start_at'] && $data['finish_at'] > $schedule['finish_at'])
					) {
						if ($data['status'] != Schedule::ACCOMPLISHED && $data['status'] != Schedule::CANCELED) {
							return [
								'error'   => true,
								'message' => 'Opeação inválida. 
                                    Já existe um compromisso neste horário para esse médico.'
							];

						}
					}
				}
			}
		} elseif ($data['type'] == 1) {
			foreach ($schedules as $schedule) {
				if ($data['doctor_id'] == $schedule['doctor_id']) {
					if (($data['start_at'] >= $schedule['start_at'] && $data['start_at'] < $schedule['finish_at']) ||
					    ($data['start_at'] <= $schedule['start_at'] && $schedule['start_at'] <= $data['finish_at']) ||
					    ($data['start_at'] < $schedule['start_at'] && $data['finish_at'] > $schedule['finish_at'])
					) {
						return [
							'error'   => true,
							'message' => 'Opeação inválida. 
							Já existe um compromisso neste horário.'
						];
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

	public function update(array $data, $id)
	{

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

		if ($data['type'] == 1 && User::isDoctor()) {
			$doctors = Doctor::all();
			foreach ($doctors as $doctor) {
				if (Auth::id() == $doctor['user_id']) {
					$data['doctor_id'] = $doctor['id'];
				}
			}
		}

		if (empty($data['doctor_id'])) {
			return [
				'error'   => true,
				'message' => 'Opeação inválida. 
				Selecione um médico.'
			];
		}

		if ($data['type'] == 0) {
			if (empty($data['doctor_id'])) {
				return [
					'error'   => true,
					'message' => 'Opeação inválida. 
					Selecione um médico.'
				];
			} elseif (empty($data['patient_id'])) {
				return [
					'error'   => true,
					'message' => 'Opeação inválida. 
					Selecione um paciente.'
				];
			}
		}

		$schedules = Schedule::all();

		if ($data['type'] == 0) {
			foreach ($schedules as $schedule) {
				if ($data['doctor_id'] == $schedule['doctor_id']) {
					if (($data['start_at'] >= $schedule['start_at'] && $data['start_at'] < $schedule['finish_at']) ||
					    ($data['start_at'] <= $schedule['start_at'] && $schedule['start_at'] <= $data['finish_at']) ||
					    ($data['start_at'] < $schedule['start_at'] && $data['finish_at'] > $schedule['finish_at'])
					) {
						if ($data['status'] != Schedule::ACCOMPLISHED && $data['status'] != Schedule::CANCELED) {
							return [
								'error'   => true,
								'message' => 'Opeação inválida. 
                                    Já existe um compromisso neste horário para esse médico.'
							];

						}
					}
				}
			}
		} elseif ($data['type'] == 1) {
			foreach ($schedules as $schedule) {
				if ($data['doctor_id'] == $schedule['doctor_id']) {
					if (($data['start_at'] >= $schedule['start_at'] && $data['start_at'] < $schedule['finish_at']) ||
					    ($data['start_at'] <= $schedule['start_at'] && $schedule['start_at'] <= $data['finish_at']) ||
					    ($data['start_at'] < $schedule['start_at'] && $data['finish_at'] > $schedule['finish_at'])
					) {
						return [
							'error'   => true,
							'message' => 'Opeação inválida. 
							Já existe um compromisso neste horário.'
						];
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