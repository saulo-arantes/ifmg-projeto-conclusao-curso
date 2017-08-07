<?php

namespace App\Http\Controllers;

use App\Repositories\LogRepository;
use App\Services\DataTables\LogsDataTable;
use App\Validators\LogValidator;

/**
 * Class LogsController
 *
 * @author  Bruno Tomé
 * @package App\Http\Controllers
 */
class LogsController extends Controller
{

    /**
     * @var LogRepository
     */
    protected $repository;

    /**
     * @var LogValidator
     */
    protected $validator;

    public function __construct(LogRepository $repository, LogValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }


    /**
     * Display a listing of the resource.
     *
     * @param LogsDataTable $dataTable
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(LogsDataTable $dataTable)
    {
        return $dataTable->render('admin.logs.list');
    }

    /**
     * Set the visualized attribute to true.
     *
     * @param $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function markAsSeen($id)
    {
        $this->repository->markAsSeen($id);

        return back();
    }

    /**
     * Set the visualized attribute to true for all non visualized messages.
     */
    public function visualizeAll()
    {
        $this->repository->visualizeAll();

        return redirect('/admin/logs');
    }

}
