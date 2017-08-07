<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserContactCreateRequest;
use App\Http\Requests\UserContactUpdateRequest;
use App\Repositories\UserContactRepository;
use App\Validators\UserContactValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class AuditsController
 *
 * @author Saulo Vinícius
 * @since 20/06/2017
 * @package App\Http\Controllers
 */
class UserContactsController extends Controller
{

    /**
     * @var UserContactRepository
     */
    protected $repository;

    /**
     * @var UserContactValidator
     */
    protected $validator;

    public function __construct(UserContactRepository $repository, UserContactValidator $validator)
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
        $userContacts = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $userContacts,
            ]);
        }

        return view('userContacts.index', compact('userContacts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserContactCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(UserContactCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $userContact = $this->repository->create($request->all());

            $response = [
                'message' => 'UserContact created.',
                'data'    => $userContact->toArray(),
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
        $userContact = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $userContact,
            ]);
        }

        return view('userContacts.show', compact('userContact'));
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

        $userContact = $this->repository->find($id);

        return view('userContacts.edit', compact('userContact'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  UserContactUpdateRequest $request
     * @param  string $id
     *
     * @return Response
     */
    public function update(UserContactUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $userContact = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'UserContact updated.',
                'data'    => $userContact->toArray(),
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
                'message' => 'UserContact deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'UserContact deleted.');
    }
}
