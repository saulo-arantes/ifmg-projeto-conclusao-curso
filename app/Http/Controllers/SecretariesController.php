<?php

namespace App\Http\Controllers;

use App\Entities\Secretary;
use App\Http\Requests\SecretaryCreateRequest;
use App\Http\Requests\SecretaryUpdateRequest;
use App\Repositories\SecretaryRepository;
use App\Validators\SecretaryValidator;
use Illuminate\Support\Facades\Auth;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class SecretariesController extends Controller
{
    protected $repository;
    protected $validator;

    public function __construct(SecretaryRepository $repository, SecretaryValidator $validator)
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
        $secretaries = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $secretaries,
            ]);
        }

        return view('secretaries.index', compact('secretaries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SecretaryCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(SecretaryCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $secretary = $this->repository->create($request->all());

            $response = [
                'message' => 'Secretary created.',
                'data'    => $secretary->toArray(),
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
        $secretary = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $secretary,
            ]);
        }

        return view('secretarys.show', compact('secretary'));
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

        $secretary = $this->repository->find($id);

        return view('secretaries.edit', compact('secretary'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  SecretaryUpdateRequest $request
     * @param  string $id
     *
     * @return Response
     */
    public function update(SecretaryUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $secretary = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Secretary updated.',
                'data'    => $secretary->toArray(),
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

    public function updateProfile(SecretaryUpdateRequest $request)
    {
        $secretary = Secretary::where('user_id', Auth::user()->id);

        return $this->update($request, $secretary->id);
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
                'message' => 'Secretary deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Secretary deleted.');
    }
}
