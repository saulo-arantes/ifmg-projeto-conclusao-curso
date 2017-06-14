<?php

namespace App\Http\Controllers;

use App\Repositories\LogRepository;
use App\Services\DataTables\UsersDataTable;
use App\Validators\LogValidator;

/**
 * Class LogsController
 *
 * @author  Saulo Vinícius
 * @package App\Http\Controllers
 */
class UsersController extends Controller
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
     * @param UsersDataTable $dataTable
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->render('admin.users.list');
    }

}
