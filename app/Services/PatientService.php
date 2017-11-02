<?php
/**
 * Created by PhpStorm.
 * User: saulo
 * Date: 14/07/17
 * Time: 09:35
 */

namespace App\Services;


use App\Entities\User;
use App\Notifications\ExceptionNotification;
use App\Notifications\ValidatorExceptionNotification;
use App\Repositories\PatientsRepository;
use App\Validators\PatientsValidator;
use Illuminate\Support\Facades\Notification;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class PatientService
 *
 * @author Saulo Vinícius
 * @since 14/07/2017
 * @package App\Services
 */
class PatientService
{

	protected $repository;
	protected $validator;

	/**
	 * PatientService constructor.
	 *
	 * @param PatientsRepository $repository
	 * @param PatientsValidator $validator
	 */
	public function __construct(PatientsRepository $repository, PatientsValidator $validator)
	{
		$this->repository = $repository;
		$this->validator  = $validator;
	}

	public function store(array $data)
	{

		$data['cpf'] = !empty($data['cpf']) ? $data['cpf'] : null;
		$data['rg']  = !empty($data['rg']) ? $data['rg'] : null;

		$data['birthday_date'] = !empty($data['birthday_date']) ? date('Y-m-d',
			strtotime($data['birthday_date'])) : null;

		if (!empty(session('photo'))) {
			$data['photo'] = session('photo');
		}

		try {

			$this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);

			$user = $this->repository->create($data);
			$this->repository->updateContacts($data, $user['data']['id']);
			$this->repository->updateDoctors($data, $user['data']['id']);

			session()->forget('photo');

			return $user['data']['id'];

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
				'message' => 'Ocorreu um erro ao adicionar o paciente.'
			];
		}
	}

	public function update(array $data, $id)
	{

		unset($data['role']);

		$data['cpf'] = !empty($data['cpf']) ? $data['cpf'] : null;
		$data['rg']  = !empty($data['rg']) ? $data['rg'] : null;

		if (!empty($data['birthday_date'])) {
			$dateTime              = date_create_from_format('d/m/Y', $data['birthday_date']);
			$data['birthday_date'] = date('Y-m-d', $dateTime->getTimestamp());
		} else {
			$data['birthday_date'] = null;
		}

		if (!empty(session('photo'))) {
			$data['photo'] = session('photo');
		}

		try {

			$this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
			$this->repository->update($data, $id);
			$this->repository->updateContacts($data, $id);
			$this->repository->updateDoctors($data, $id);

			session()->forget('photo');

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
				'message' => 'Ocorreu um erro ao editar o paciente.'
			];

		}
	}
}