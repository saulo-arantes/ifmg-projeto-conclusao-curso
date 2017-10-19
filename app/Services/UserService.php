<?php

namespace App\Services;

use App\Entities\User;
use App\Http\Requests\UserUpdateRequest;
use App\Notifications\ExceptionNotification;
use App\Notifications\ValidatorExceptionNotification;
use App\Notifications\WelcomeEmailNotification;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Validator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;


/**
 * Class UserService
 *
 * @author Saulo Vinícius
 * @since 20/06/2017
 * @package App\Services
 */
class UserService {

	protected $repository;
	protected $validator;

	/**
	 * UserService constructor.
	 *
	 * @param UserRepository $repository
	 * @param UserValidator $validator
	 */
	public function __construct(UserRepository $repository, UserValidator $validator) {
		$this->repository = $repository;
		$this->validator  = $validator;
	}

	public function store(array $data) {

		$data['status'] = 1;

		$data['cpf'] = !empty($data['icpf']) ? $data['icpf'] : null;
		$data['rg']  = !empty($data['rg']) ? $data['rg'] : null;

		$data['birthday_date'] = !empty($data['birthday_date']) ? date('Y-m-d',
			strtotime($data['birthday_date'])) : null;

		if (!empty(session('photo'))) {
			$data['photo'] = session('photo');
		}

		try {

			$this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);

			$password = $this->repository->generatePassword();
			$data['password'] = bcrypt($password);
			$data['password_confirmation'] = $data['password'];



			$user = $this->repository->create($data);

			$user = (new User())->find($user['data']['id']);
			$user->email_address = $user->email;
			$this->repository->updateContacts($data, $user->id);

			session()->forget('photo');

			Notification::send($user,
				new WelcomeEmailNotification($data['email'], $password));

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
				'message' => 'Ocorreu um erro ao adicionar o usuário.'
			];
		}
	}

	public function update(array $data, $id) {

		unset($data['role']);

		$data['cpf'] = !empty($data['icpf']) ? $data['icpf'] : null;
		$data['rg']  = !empty($data['rg']) ? $data['rg'] : null;

		if (!empty($data['birthday_date'])) {
			$dateTime              = date_create_from_format('d/m/Y', $data['birthday_date']);
			$data['birthday_date'] = date('Y-m-d H:i:s', $dateTime->getTimestamp());
		} else {
			$data['birthday_date'] = null;
		}

		if (!empty(session('photo'))) {
			$data['photo'] = session('photo');
		}

		try {

			$this->validator->setId($id);
			$this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
			$this->repository->update($data, $id);
			$this->repository->updateContacts($data, $id);

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
				'message' => 'Ocorreu um erro ao editar o usuário.'
			];

		}
	}

	/**
	 * @param $id
	 *
	 * @return array|bool
	 */
	public function changeUserStatus($id) {
		try {
			$user = $this->repository->find($id);
			$this->repository->changeUserStatus($user['data']['id']);

			return true;
		} catch (\Exception $exception) {

			Notification::send(User::allAdmins(),
				new ExceptionNotification($exception->getFile(), $exception->getLine(),
					$exception->getMessage()));

			return [
				'error'   => true,
				'message' => 'Ocorreu um erro ao alterar o status do usuário.'
			];
		}
	}

	/**
	 * @param UserUpdateRequest $request
	 *
	 * @return array
	 */
	public function updatePassword(UserUpdateRequest $request) {
		try {
			# pt-br for beautify validation response
			$data['senha_atual']          = $request->input('current_password');
			$data['senha']                = $request->input('password');
			$data['confirmar_nova_senha'] = $request->input('password_confirmation');

			$validator = $this->passwordValidator($data);

			if ($validator->fails()) {

				return [
					'error'   => true,
					'message' => $validator->getMessageBag()->first()
				];
			}

			if (Hash::check($data['senha_atual'], Auth::user()->password)) {
				Auth::user()->fill([
					'password' => bcrypt($data['senha'])
				])->save();

				return [
					'error'   => false,
					'message' => 'Senha atualizada com sucesso.'
				];
			}

			return [
				'error'   => true,
				'message' => 'Ocorreu um erro ao atualizar a senha.'
			];

		} catch (\Exception $exception) {

			Notification::send(User::allAdmins(),
				new ExceptionNotification($exception->getFile(), $exception->getLine(),
					$exception->getMessage()));

			return [
				'error'   => true,
				'message' => 'Ocorreu um erro ao atualizar a senha.'
			];

		}
	}

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array $data
	 *
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	private function passwordValidator(array $data) {
		return Validator::make($data,
			[
				'senha_atual'          => 'required',
				'senha'                => 'required|min:8',
				'confirmar_nova_senha' => 'required|same:senha|min:8',
			]);
	}

}