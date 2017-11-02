<?php

namespace App\Http\Controllers;

use App\Entities\User;
use App\Http\Requests\PatientsCreateRequest;
use App\Http\Requests\PatientsUpdateRequest;
use App\Repositories\PatientsRepository;
use App\Services\DataTables\PatientsDataTable;
use App\Services\PatientService;

/**
 * Class AuditsController
 *
 * @author Saulo Vinícius
 * @since 20/06/2017
 * @package App\Http\Controllers
 */
class PatientsController extends Controller
{

	protected $repository;
	protected $service;

	public function __construct(PatientsRepository $repository, PatientService $service)
	{
		$this->repository = $repository;
		$this->service    = $service;
	}

	public function index(PatientsDataTable $dataTable)
	{
		return $dataTable->render('admin.patients.list');
	}

	public function create()
	{
		$extraData = $this->repository->getExtraData();

		return view(User::getUserMiddleware() . '.patients.create', compact('extraData'));
	}

	public function store(PatientsCreateRequest $request)
	{
		$resultFromStorePatient = $this->service->store($request->all());

		if (!empty($resultFromStorePatient['error'])) {
			alert()->error($resultFromStorePatient['message'], 'Erro :(')->persistent('Fechar');

			return back()->withInput();
		}

		alert()->success('Paciente adicionado com sucesso!', 'Feito :)');

		return redirect('/' . User::getUserMiddleware() . '/patients');
	}

	public function edit($id)
	{
		$patient                          = $this->repository->find($id);
		$extraData                        = $this->repository->getExtraData($id);
		$patient['data']['birthday_date'] = date('d/m/Y', strtotime($patient['data']['birthday_date']));

		return view('admin.patients.edit', compact('patient'), compact('extraData'));
	}

	public function update(PatientsUpdateRequest $request, $id)
	{

		$resultFromUpdatePatient = $this->service->update($request->all(), $id);

		if (!empty($resultFromUpdatePatient['error'])) {
			alert()->error($resultFromUpdatePatient['message'], 'Erro :(')->persistent('Fechar');

			return back()->withInput();
		}

		alert()->success('Paciente atualizado com sucesso!', 'Feito :)');

		return back()->withInput();
	}
}
