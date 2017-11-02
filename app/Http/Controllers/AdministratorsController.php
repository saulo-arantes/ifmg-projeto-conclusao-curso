<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdministratorCreateRequest;
use App\Http\Requests\AdministratorUpdateRequest;
use App\Repositories\AdministratorRepository;
use App\Validators\AdministratorValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class AuditsController
 *
 * @author Saulo Vinícius
 * @since 14/06/2017@since 07/08/2017
 * @package App\Http\Controllers
 */
class AdministratorsController extends Controller
{

	/**
	 * @var AdministratorRepository
	 */
	protected $repository;

	/**
	 * @var AdministratorValidator
	 */
	protected $validator;

	public function __construct(AdministratorRepository $repository, AdministratorValidator $validator)
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
		$administrators = $this->repository->all();

		if (request()->wantsJson()) {

			return response()->json([
				'data' => $administrators,
			]);
		}

		return view('administrators.index', compact('administrators'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  AdministratorCreateRequest $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store(AdministratorCreateRequest $request)
	{

		try {

			$this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

			$administrator = $this->repository->create($request->all());

			$response = [
				'message' => 'Administrator created.',
				'data'    => $administrator->toArray(),
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
		$administrator = $this->repository->find($id);

		if (request()->wantsJson()) {

			return response()->json([
				'data' => $administrator,
			]);
		}

		return view('administrators.show', compact('administrator'));
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

		$administrator = $this->repository->find($id);

		return view('administrators.edit', compact('administrator'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  AdministratorUpdateRequest $request
	 * @param  string $id
	 *
	 * @return Response
	 */
	public function update(AdministratorUpdateRequest $request, $id)
	{

		try {

			$this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

			$administrator = $this->repository->update($request->all(), $id);

			$response = [
				'message' => 'Administrator updated.',
				'data'    => $administrator->toArray(),
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
				'message' => 'Administrator deleted.',
				'deleted' => $deleted,
			]);
		}

		return redirect()->back()->with('message', 'Administrator deleted.');
	}
}
