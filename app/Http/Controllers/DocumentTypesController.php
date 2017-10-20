<?php

namespace App\Http\Controllers;

use App\Entities\User;
use App\Http\Requests\DocumentTypeCreateRequest;
use App\Http\Requests\DocumentTypeUpdateRequest;
use App\Repositories\DocumentTypeRepository;
use App\Services\DataTables\DocumentTypesDataTable;
use App\Validators\DocumentTypeValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class DocumentTypesController
 *
 * @author Saulo Vinícius
 * @since 20/06/2017
 * @package App\Http\Controllers
 */
class DocumentTypesController extends Controller
{

    /**
     * @var DocumentTypeRepository
     */
    protected $repository;

    /**
     * @var DocumentTypeValidator
     */
    protected $validator;

    public function __construct(DocumentTypeRepository $repository, DocumentTypeValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    public function create()
    {

        return view(User::getUserMiddleware() . '.document-types.create');
    }

    public function index(DocumentTypesDataTable $dataTable)
    {
        return $dataTable->render(User::getUserMiddleware() . 'documents.list');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  DocumentTypeCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(DocumentTypeCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $DocumentType = $this->repository->create($request->all());

            $response = [
                'message' => 'DocumentType created.',
                'data'    => $DocumentType->toArray(),
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
        $DocumentType = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $DocumentType,
            ]);
        }

        return view('DocumentTypes.show', compact('DocumentType'));
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

        $DocumentType = $this->repository->find($id);

        return view('DocumentTypes.edit', compact('DocumentType'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  DocumentTypeUpdateRequest $request
     * @param  string $id
     *
     * @return Response
     */
    public function update(DocumentTypeUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $DocumentType = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'DocumentType updated.',
                'data'    => $DocumentType->toArray(),
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
                'message' => 'DocumentType deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'DocumentType deleted.');
    }
}
