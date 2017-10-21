<?php

namespace App\Services;

use App\Entities\User;
use App\Notifications\ExceptionNotification;
use App\Notifications\ValidatorExceptionNotification;
use App\Repositories\DocumentTypeRepository;
use App\Validators\DocumentTypeValidator;
use Illuminate\Support\Facades\Notification;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class DocumentTypeService
 *
 * @author Saulo Vinícius
 * @since 21/10/2017
 * @package App\Services
 */
class DocumentTypeService
{
	protected $repository;
	protected $validator;

	/**
	 * DocumentTypeService constructor.
	 *
	 * @param DocumentTypeRepository $repository
	 * @param DocumentTypeValidator $validator
	 */
	public function __construct(DocumentTypeRepository $repository, DocumentTypeValidator $validator)
	{
		$this->repository = $repository;
		$this->validator  = $validator;
	}

	public function store(array $data)
	{
		try {

			$this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
			$documentType = $this->repository->create($data);

			return $documentType['data']['id'];
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
				'message' => 'Ocorreu um erro ao adicionar um tipo de documento.'
			];
		}
	}

	public function update(array $data, $id)
	{
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
				'message' => 'Ocorreu um erro ao editar o tipo de documento.'
			];

		}
	}

}