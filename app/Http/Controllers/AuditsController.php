<?php

namespace App\Http\Controllers;

use App\Services\DataTables\AuditsDataTable;

/**
 * Class AuditsController
 *
 * @author Saulo Vinícius
 * @since 07/08/2017
 * @package App\Http\Controllers
 */
class AuditsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param AuditsDataTable $dataTable
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(AuditsDataTable $dataTable)
    {
        return $dataTable->render('admin.audits.list');
    }
}
