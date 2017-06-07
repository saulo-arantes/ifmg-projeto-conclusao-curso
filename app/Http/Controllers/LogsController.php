<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use App\Repositories\LogRepository;
use App\Services\DataTables\LogsDataTable;
use App\Validators\LogValidator;

/**
 * Class LogsController
 *
 * @author  Bruno Tomé
 * @package TARS\Http\Controllers
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->repository->delete($id);
            alert()->success('Log deletado com sucesso.', 'Feito :)');
            return back();
        } catch (QueryException $e) {
            $this->repository->error($e);

            alert()->error('Log não pode ser deletado pois existem vínculos a ele.', 'Erro :(')
                ->persistent('Fechar');
            return back();
        } catch (ModelNotFoundException $e) {
            $this->repository->error($e);

            alert()->error('Log não encontrado.', 'Erro :(')->persistent('Fechar');
            return back();
        } catch (\Exception $e) {
            $this->repository->error($e);

            alert()->error('Ocorreu um erro ao deletar o log.', 'Erro :(')->persistent('Fechar');
            return back();
        }
    }
}
