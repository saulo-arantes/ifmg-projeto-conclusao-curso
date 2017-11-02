<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Doctor;
use App\Http\Requests\DoctorCreateRequest;
use App\Http\Requests\DoctorUpdateRequest;
use App\Repositories\DoctorRepository;
use App\Validators\DoctorValidator;
use Illuminate\Support\Facades\Auth;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class AuditsController
 *
 * @author Saulo Vinícius
 * @since 16/07/2017
 * @package App\Http\Controllers
 */
class DoctorsController extends Controller
{


	protected $repository;
	protected $validator;

	public function __construct(DoctorRepository $repository, DoctorValidator $validator)
	{
		$this->repository = $repository;
		$this->validator  = $validator;
	}


	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
		$doctors = $this->repository->all();

		if (request()->wantsJson()) {

			return response()->json([
				'data' => $doctors,
			]);
		}

		return view('doctors.index', compact('doctors'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  DoctorCreateRequest $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(DoctorCreateRequest $request)
	{

		try {

			$this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

			$doctor = $this->repository->create($request->all());

			$response = [
				'message' => 'Doctor created.',
				'data'    => $doctor->toArray(),
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
		$doctor = $this->repository->find($id);

		if (request()->wantsJson()) {

			return response()->json([
				'data' => $doctor,
			]);
		}

		return view('doctors.show', compact('doctor'));
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

		$doctor = $this->repository->find($id);

		return view('doctors.edit', compact('doctor'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  DoctorUpdateRequest $request
	 * @param  string $id
	 *
	 * @return Response
	 */
	public function update(DoctorUpdateRequest $request, $id)
	{

		try {

			$this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

			$doctor = $this->repository->update($request->all(), $id);

			$response = [
				'message' => 'Doctor updated.',
				'data'    => $doctor->toArray(),
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

	public function updateProfile(DoctorUpdateRequest $request)
	{
		$doctor = Doctor::where('user_id', Auth::user()->id);

		return $this->update($request, $doctor->id);
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
				'message' => 'Doctor deleted.',
				'deleted' => $deleted,
			]);
		}

		return redirect()->back()->with('message', 'Doctor deleted.');
	}
}
