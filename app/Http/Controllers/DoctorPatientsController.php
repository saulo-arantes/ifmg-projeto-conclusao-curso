<?php

namespace App\Http\Controllers;

use App\Http\Requests\DoctorPatientCreateRequest;
use App\Http\Requests\DoctorPatientUpdateRequest;
use App\Repositories\DoctorPatientRepository;
use App\Validators\DoctorPatientValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;


class DoctorPatientsController extends Controller
{

    /**
     * @var DoctorPatientRepository
     */
    protected $repository;

    /**
     * @var DoctorPatientValidator
     */
    protected $validator;

    public function __construct(DoctorPatientRepository $repository, DoctorPatientValidator $validator)
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
        $doctorPatients = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $doctorPatients,
            ]);
        }

        return view('doctorPatients.index', compact('doctorPatients'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  DoctorPatientCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(DoctorPatientCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $doctorPatient = $this->repository->create($request->all());

            $response = [
                'message' => 'DoctorPatient created.',
                'data'    => $doctorPatient->toArray(),
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
        $doctorPatient = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $doctorPatient,
            ]);
        }

        return view('doctorPatients.show', compact('doctorPatient'));
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

        $doctorPatient = $this->repository->find($id);

        return view('doctorPatients.edit', compact('doctorPatient'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  DoctorPatientUpdateRequest $request
     * @param  string $id
     *
     * @return Response
     */
    public function update(DoctorPatientUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $doctorPatient = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'DoctorPatient updated.',
                'data'    => $doctorPatient->toArray(),
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
                'message' => 'DoctorPatient deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'DoctorPatient deleted.');
    }
}
