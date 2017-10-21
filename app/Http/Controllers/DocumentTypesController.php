<?php

namespace App\Http\Controllers;

use App\Entities\User;
use App\Http\Requests\DocumentTypeCreateRequest;
use App\Http\Requests\DocumentTypeUpdateRequest;
use App\Repositories\DocumentTypeRepository;
use App\Services\DataTables\DocumentTypesDataTable;
use App\Services\DocumentTypeService;

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
	 * @var DocumentTypeService
	 */
	protected $service;

	public function __construct(DocumentTypeRepository $repository, DocumentTypeService $service)
	{
		$this->repository = $repository;
		$this->service    = $service;
	}

	public function create()
	{
		return view(User::getUserMiddleware() . '.document-types.create');
	}

	public function index(DocumentTypesDataTable $dataTable)
	{
		return $dataTable->render(User::getUserMiddleware() . '.document-types.list');
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

		$resultFromStoreDocumentType = $this->service->store($request->all());

		if (!empty($resultFromStoreDocumentType['error'])) {
			alert()->error($resultFromStoreDocumentType['message'], 'Erro :(')->persistent('Fechar');

			return back()->withInput();
		}

		alert()->success('Tipo de Documento adicionado com sucesso!', 'Feito :)');

		return redirect('/' . User::getUserMiddleware() . '/documents');
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
		$documentType = $this->repository->find($id);
		$extraData    = $this->repository->getExtraData($id);

		return view(User::getUserMiddleware() . '.document-types.edit', compact('documentType'), compact('extraData'));
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
		$resultFromUpdateDocumentType = $this->service->update($request->all(), $id);

		if (!empty($resultFromUpdateDocumentType['error'])) {
			alert()->error($resultFromUpdateDocumentType['message'], 'Erro :(')->persistent('Fechar');

			return back()->withInput();
		}

		alert()->success('Tipo de Documento atualizado com sucesso!', 'Feito :)');

		return back()->withInput();
	}

}
