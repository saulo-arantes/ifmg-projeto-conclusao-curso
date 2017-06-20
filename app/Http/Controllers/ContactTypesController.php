<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ContactTypeCreateRequest;
use App\Http\Requests\ContactTypeUpdateRequest;
use App\Repositories\ContactTypeRepository;
use App\Validators\ContactTypeValidator;


class ContactTypesController extends Controller
{

    /**
     * @var ContactTypeRepository
     */
    protected $repository;

    /**
     * @var ContactTypeValidator
     */
    protected $validator;

    public function __construct(ContactTypeRepository $repository, ContactTypeValidator $validator)
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
        $contactTypes = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $contactTypes,
            ]);
        }

        return view('contactTypes.index', compact('contactTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ContactTypeCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ContactTypeCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $contactType = $this->repository->create($request->all());

            $response = [
                'message' => 'ContactType created.',
                'data'    => $contactType->toArray(),
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
        $contactType = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $contactType,
            ]);
        }

        return view('contactTypes.show', compact('contactType'));
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

        $contactType = $this->repository->find($id);

        return view('contactTypes.edit', compact('contactType'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  ContactTypeUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(ContactTypeUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $contactType = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'ContactType updated.',
                'data'    => $contactType->toArray(),
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
                'message' => 'ContactType deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'ContactType deleted.');
    }
}
