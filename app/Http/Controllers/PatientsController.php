<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientsCreateRequest;
use App\Http\Requests\PatientsUpdateRequest;
use App\Repositories\PatientsRepository;
use App\Services\DataTables\PatientsDataTable;
use App\Validators\PatientsValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;


class PatientsController extends Controller
{

    /**
     * @var PatientsRepository
     */
    protected $repository;

    /**
     * @var PatientsValidator
     */
    protected $validator;

    public function __construct(PatientsRepository $repository, PatientsValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    public function index(PatientsDataTable $dataTable)
    {
        return $dataTable->render('admin.patients.list');
    }

    public function create()
    {
        return view('admin.patients.create');
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

        return view('admin.patients.edit', compact('patient'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  PatientsUpdateRequest $request
     * @param  string $id
     *
     * @return Response
     */
    public function update(PatientsUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $patient = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Patients updated.',
                'data'    => $patient->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Patients deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Patients deleted.');
    }
}
