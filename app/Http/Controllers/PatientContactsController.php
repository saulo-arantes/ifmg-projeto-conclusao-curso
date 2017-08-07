<?php

namespace App\Http\Controllers;

use App\Http\Requests\PatientContactCreateRequest;
use App\Http\Requests\PatientContactUpdateRequest;
use App\Repositories\PatientContactRepository;
use App\Validators\PatientContactValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;


class PatientContactsController extends Controller
{

    /**
     * @var PatientContactRepository
     */
    protected $repository;

    /**
     * @var PatientContactValidator
     */
    protected $validator;

    public function __construct(PatientContactRepository $repository, PatientContactValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $patientContacts = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $patientContacts,
            ]);
        }

        return view('patientContacts.index', compact('patientContacts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PatientContactCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PatientContactCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $patientContact = $this->repository->create($request->all());

            $response = [
                'message' => 'PatientContact created.',
                'data'    => $patientContact->toArray(),
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
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patientContact = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $patientContact,
            ]);
        }

        return view('patientContacts.show', compact('patientContact'));
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

        $patientContact = $this->repository->find($id);

        return view('patientContacts.edit', compact('patientContact'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  PatientContactUpdateRequest $request
     * @param  string $id
     *
     * @return Response
     */
    public function update(PatientContactUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $patientContact = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'PatientContact updated.',
                'data'    => $patientContact->toArray(),
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
                'message' => 'PatientContact deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'PatientContact deleted.');
    }
}
