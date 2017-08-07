<?php

namespace App\Services;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Repositories\LogRepository;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;


/**
 * Class UserService
 *
 * @package App\Services
 */
class UserService
{

    /**
     * @var UserRepository
     */
    protected $repository;

    /**
     * @var UserValidator
     */
    protected $validator;

    /**
     * @var LogRepository
     */
    protected $log;

    /**
     * UserService constructor.
     *
     * @param UserRepository $repository
     * @param UserValidator $validator
     * @param LogRepository $log
     */
    public function __construct(UserRepository $repository, UserValidator $validator, LogRepository $log)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->log = $log;
    }

    /**
     *
     * @param UserCreateRequest $request
     *
     * @return array
     */
    public function store(UserCreateRequest $request)
    {
        try {

            $data = $request->all();

            $data['password'] = 'senha123';
            $data['password_confirmation'] = 'senha123';
            $data['status'] = 0;

            $data['cpf'] = !empty($data['icpf']) ? $data['icpf'] : null;
            $data['rg'] = !empty($data['rg']) ? $data['rg'] : null;

            $data['birthday_date'] = !empty($data['birthday_date']) ? date('Y-m-d',
                strtotime($data['birthday_date'])) : null;

            if (!empty(session('photo'))) {
                $data['photo'] = session('photo');
            }

            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);

            $user = $this->repository->create($data);
            $this->repository->updateContacts($data, $user['data']['id']);

            session()->forget('photo');

            return $user['data']['id'];

        } catch (ValidatorException $e) {
            $this->log->validatorException($e);

            return [
                'error'   => true,
                'message' => $e->getMessageBag()->first()
            ];
        } catch (\Exception $e) {
            $this->log->error($e);

            return [
                'error'   => true,
                'message' => 'Ocorreu um erro ao adicionar o usuário.'
            ];
        }
    }

    /**
     *
     * @param UserUpdateRequest $request
     * @param $id
     *
     * @return array|bool
     */
    public function update(UserUpdateRequest $request, $id)
    {

        try {
            $data = $request->except('level');

            $data['cpf'] = !empty($data['icpf']) ? $data['icpf'] : null;
            $data['rg'] = !empty($data['rg']) ? $data['rg'] : null;

            if (!empty($data['birthday_date'])) {
                $dateTime = date_create_from_format('d/m/Y', $data['birthday_date']);
                $data['birthday_date'] = date('Y-m-d H:i:s', $dateTime->getTimestamp());
            } else {
                $data['birthday_date'] = null;
            }

            if (!empty(session('photo'))) {
                $data['photo'] = session('photo');
            }

            $this->validator->setId($id);
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $this->repository->update($data, $id);
            $this->repository->updateContacts($data, $id);

            session()->forget('photo');

            return true;
        } catch (ValidatorException $e) {
            $this->log->validatorException($e);

            return [
                'error'   => true,
                'message' => $e->getMessageBag()->first()
            ];
        } catch (ModelNotFoundException $e) {
            $this->log->error($e);

            return [
                'error'   => true,
                'message' => 'Usuário não encontrado.'
            ];

        } catch (\Exception $e) {
            $this->log->error($e);

            return [
                'error'   => true,
                'message' => 'Ocorreu um erro ao editar o usuário.'
            ];

        }
    }

    /**
     * @param $id
     *
     * @return array|bool
     */
    public function changeUserStatus($id)
    {
        try {
            $user = $this->repository->find($id);
            $this->repository->changeUserStatus($user['data']['id']);

            return true;
        } catch (ModelNotFoundException $e) {
            $this->log->error($e);

            return [
                'error'   => true,
                'message' => 'Usuário não encontrado.'
            ];

        } catch (\Exception $e) {
            $this->log->error($e);

            return [
                'error'   => true,
                'message' => 'Ocorreu um erro ao alterar o status do usuário.'
            ];
        }
    }

    /**
     * @param UserUpdateRequest $request
     *
     * @return array
     */
    public function updatePassword(UserUpdateRequest $request)
    {
        try {
            # pt-br for beautify validation response
            $data['senha_atual'] = $request->input('current_password');
            $data['senha'] = $request->input('password');
            $data['confirmar_nova_senha'] = $request->input('password_confirmation');

            $validator = $this->passwordValidator($data);

            if ($validator->fails()) {

                return [
                    'error'   => true,
                    'message' => $validator->getMessageBag()->first()
                ];
            }

            if (Hash::check($data['senha_atual'], Auth::user()->password)) {
                Auth::user()->fill([
                    'password' => bcrypt($data['senha'])
                ])->save();

                return [
                    'error'   => false,
                    'message' => 'Senha atualizada com sucesso.'
                ];
            }
        } catch (ModelNotFoundException $e) {
            $this->log->error($e);

            return [
                'error'   => true,
                'message' => 'Usuário não encontrado.'
            ];
        } catch (\Exception $e) {
            $this->log->error($e);

            return [
                'error'   => true,
                'message' => 'Ocorreu um erro ao atualizar a senha.'
            ];

        }
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     *
     * @return \Illuminate\Contracts\Validation\Validator
     */
    private function passwordValidator(array $data)
    {
        return Validator::make($data,
            [
                'senha_atual'          => 'required',
                'senha'                => 'required|min:8',
                'confirmar_nova_senha' => 'required|same:senha|min:8',
            ]);
    }

}