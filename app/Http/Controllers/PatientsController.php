<?php

namespace App\Http\Controllers;

use App\Entities\User;
use App\Http\Requests\PatientsCreateRequest;
use App\Http\Requests\PatientsUpdateRequest;
use App\Repositories\PatientsRepository;
use App\Services\DataTables\PatientsDataTable;
use App\Services\PatientService;


class PatientsController extends Controller
{

    /**
     * @var PatientsRepository
     */
    protected $repository;

    /**
     * @var PatientService
     */
    protected $service;

    public function __construct(PatientsRepository $repository, PatientService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
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

    /**
     * Stores a patient.
     *
     * @param PatientsCreateRequest $request
     * @param null $otherController
     *
     * @return array|\Illuminate\Http\RedirectResponse
     */
    public function store(PatientsCreateRequest $request, $otherController = null)
    {
        $resultFromStoreUser = $this->service->store($request, $otherController);

        if (!empty($otherController)) {
            return $resultFromStoreUser;
        }

        if (!empty($resultFromStoreUser['error'])) {
            alert()->error($resultFromStoreUser['message'], 'Erro :(')->persistent('Fechar');

            return back()->withInput();
        }

        alert()->success('Paciente adicionado com sucesso!', 'Feito :)');

        return redirect('/admin/patients');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patient = $this->repository->find($id);
        $extraData = $this->repository->getExtraData($id);
        $patient['data']['birthday_date'] = date('d/m/Y', strtotime($patient['data']['birthday_date']));

        return view('admin.patients.edit', compact('patient'), compact('extraData'));
    }


    /**
     * Updates an user.
     *
     * @param PatientsUpdateRequest $request
     * @param $id
     * @param null $otherController
     *
     * @return array|bool|\Illuminate\Http\RedirectResponse
     */
    public function update(PatientsUpdateRequest $request, $id, $otherController = null)
    {

        $resultFromUpdateUser = $this->service->update($request, $id);

        if (!empty($otherController)) {
            return $resultFromUpdateUser;
        }

        if (!empty($resultFromUpdateUser['error'])) {
            alert()->error($resultFromUpdateUser['message'], 'Erro :(')->persistent('Fechar');

            return back()->withInput();
        }

        alert()->success('Paciente atualizado com sucesso!', 'Feito :)');

        return back()->withInput();
    }
}
