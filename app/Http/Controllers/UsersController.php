<?php

namespace App\Http\Controllers;

use App\Entities\Log;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\LogRepository;
use App\Services\DataTables\UsersDataTable;
use App\Validators\LogValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

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
        $this->validator  = $validator;
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

    /**
     * Show the form for add a new resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $user = null;
        return view('admin.users.create', compact('user'));
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
        $user = $this->repository->find($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserCreateRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(UserCreateRequest $request)
    {
        try {
            $data = $request->all();
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);
            $data['password'] = bcrypt($data['password']);
            $data['password_confirmation'] = $data['password'];
            $data['level'] = 0;
            $this->repository->create($data);
            alert()->success('Administrador adicionado com sucesso.', 'Feito :)');
            return redirect('/admin/users');
        } catch (ValidatorException $e) {
            Log::create([
                'user_id'     => Auth::user()->id,
                'description' => 'Arquivo => ' . $e->getFile() . '<br><br>Linha => ' . $e->getLine() . '<br><br>ValidatorException => ' . $e->getMessageBag()->first(),
                'type'        => 0
            ]);
            alert()->error($e->getMessageBag()->first(),
                'Erro :(')->persistent('Fechar');
            return back()->withInput();
        } catch (\Exception $e) {
            Log::create([
                'user_id'     => Auth::user()->id,
                'description' => 'Arquivo => ' . $e->getFile() . '<br><br>Linha => ' . $e->getLine() . '<br><br>Exception => ' . $e->getMessage(),
                'type'        => 0
            ]);
            alert()->error('Ocorreu um erro ao adicionar o administrador.', 'Erro :(')->persistent('Fechar');
            return back()->withInput();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserUpdateRequest $request
     * @param  string $id
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UserUpdateRequest $request, $id)
    {
        try {
            $data = $request->except('level');
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $this->repository->update($data, $id);
            alert()->success('Usuário atualizado com sucesso.', 'Feito :)');
            return redirect('/admin/users');
        } catch (ValidatorException $e) {
            Log::create([
                'user_id'     => Auth::user()->id,
                'description' => 'Arquivo => ' . $e->getFile() . '<br><br>Linha => ' . $e->getLine() . '<br><br>ValidatorException => ' . $e->getMessageBag()->first(),
                'type'        => 0
            ]);
            alert()->error($e->getMessageBag()->first(),
                'Erro :(')->persistent('Fechar');
            return back();
        } catch (ModelNotFoundException $e) {
            Log::create([
                'user_id'     => Auth::user()->id,
                'description' => 'Arquivo => ' . $e->getFile() . '<br><br>Linha => ' . $e->getLine() . '<br><br>ModelNotFoundException => ' . $e->getMessage(),
                'type'        => 0
            ]);
            alert()->error('Usuário não encontrado.', 'Erro :(')->persistent('Fechar');
            return back();
        } catch (\Exception $e) {
            Log::create([
                'user_id'     => Auth::user()->id,
                'description' => 'Arquivo => ' . $e->getFile() . '<br><br>Linha => ' . $e->getLine() . '<br><br>Exception => ' . $e->getMessage(),
                'type'        => 0
            ]);
            alert()->error('Ocorreu um erro ao atualizar o usuário.', 'Erro :(')->persistent('Fechar');
            return back();
        }
    }
}
