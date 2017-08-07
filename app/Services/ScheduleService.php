<?php
/**
 * Created by PhpStorm.
 * User: saulo
 * Date: 04/08/17
 * Time: 09:26
 */

namespace App\Services;


use App\Http\Requests\ScheduleCreateRequest;
use App\Repositories\LogRepository;
use App\Repositories\UserRepository;
use App\Validators\UserValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

class ScheduleService
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
     * ScheduleService constructor.
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
     * @param ScheduleCreateRequest $request
     *
     * @return array
     */
    public function store(ScheduleCreateRequest $request)
    {
        try {

            $data = $request->all();;

            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);

            $schedule = $this->repository->create($data);

            return $schedule['data']['id'];

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
                'message' => 'Ocorreu um erro ao adicionar agendamento.'
            ];
        }
    }

    public function update(ScheduleCreateRequest $request, $id)
    {
        try {
            $data = $request->except('level');

            $this->validator->setId($id);
            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $this->repository->update($data, $id);

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
                'message' => 'Agendamento não encontrado.'
            ];

        } catch (\Exception $e) {
            $this->log->error($e);

            return [
                'error'   => true,
                'message' => 'Ocorreu um erro ao editar o agendamento.'
            ];

        }
    }


}