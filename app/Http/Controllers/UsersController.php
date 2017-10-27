<?php

namespace App\Http\Controllers;

use App\Entities\Doctor;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\UserRepository;
use App\Services\DataTables\UsersDataTable;
use App\Services\UserService;
use App\Validators\UserValidator;
use Illuminate\Support\Facades\Auth;


/**
 * Class AuditsController
 *
 * @author Saulo Vinícius
 * @since 30/05/2017
 * @package App\Http\Controllers
 */
class UsersController extends Controller
{
	/**
	 * @var UserRepository
	 */
	protected $repository;

	/**
	 * @var UserValidator
	 */
	protected $service;

	/**
	 * UsersController constructor.
	 *
	 * @param UserRepository $repository
	 * @param UserService $service
	 */
	public function __construct(UserRepository $repository, UserService $service)
	{
		$this->repository = $repository;
		$this->service    = $service;
	}

	public function index(UsersDataTable $dataTable)
	{
		return $dataTable->render('admin.users.list');
	}

	public function edit($id)
	{
		$user      = $this->repository->find($id);
		$extraData = $this->repository->getExtraData();

		return view('admin.users.edit', compact('user'), compact('extraData'));
	}

	public function create()
	{
		$extraData = $this->repository->getExtraData();

		return view('admin.users.create', compact('extraData'));
	}

	public function store(UserCreateRequest $request)
	{

		$resultFromStoreUser = $this->service->store($request->all());

		if (!empty($resultFromStoreUser['error'])) {
			alert()->error($resultFromStoreUser['message'], 'Erro :(')->persistent('Fechar');

			return back()->withInput();
		}

		alert()->success('Usuário adicionado com sucesso!', 'Feito :)');

		return redirect('/admin/users');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function changeUserStatus($id)
	{
		$resultFromChangeUserStatus = $this->service->changeUserStatus($id);

		if (!empty($resultFromChangeUserStatus['error'])) {
			alert()->error($resultFromChangeUserStatus['message'], 'Erro :(')->persistent('Fechar');
		}

		alert()->success('Status do usuário alterado com sucesso.', 'Feito :)');

		return back();
	}

	/**
	 * Upload the fighter profile picture.
	 *
	 * @return string
	 */
	public function uploadAnyUserAvatar()
	{
		$imageName = $this->repository->uploadAvatar();

		if (!empty($imageName['error'])) {
			return response($imageName['message'], 400);
		}

		session(['photo' => $imageName]);

		return response('Foto salva com sucesso.', 200);
	}

	/**
	 * Upload the users profile picture.
	 *
	 * @return string
	 */
	public function uploadProfileAvatar()
	{
		$imageName = $this->repository->uploadAvatar();

		if (!empty($imageName['error'])) {
			return response($imageName['message'], 400);
		}

		Auth::user()->update(['photo' => $imageName]);

		return response('Foto salva com sucesso.', 200);
	}

	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function profile()
	{
		$user      = $this->repository->find(Auth::user()->id);
		$extraData = $this->repository->getExtraData();

		return view('profile', compact('user'), compact('extraData'));
	}

	/**
	 * @param UserUpdateRequest $request
	 *
	 * @return array|bool|\Illuminate\Http\RedirectResponse
	 */
	public function updateProfile(UserUpdateRequest $request)
	{
		return $this->update($request, Auth::user()->id);
	}

	public function update(UserUpdateRequest $request, $id)
	{

		$resultFromUpdateUser = $this->service->update($request->all(), $id);

		if (!empty($resultFromUpdateUser['error'])) {
			alert()->error($resultFromUpdateUser['message'], 'Erro :(')->persistent('Fechar');

			return back()->withInput();
		}

		alert()->success('Usuário atualizado com sucesso!', 'Feito :)');

		return back()->withInput();
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param $request
	 *
	 * @return array|\Illuminate\Http\RedirectResponse
	 */
	public function updatePassword(UserUpdateRequest $request)
	{
		$resultFromChangePassword = $this->service->updatePassword($request);

		if ($resultFromChangePassword['error']) {
			alert()->error($resultFromChangePassword['message'], 'Erro :(')->persistent('Fechar');
		} else {
			alert()->success($resultFromChangePassword['message'], 'Feito :)');
		}

		return back();

	}


}