<?php
/**
 * Created by PhpStorm.
 * User: saulo
 * Date: 14/07/17
 * Time: 09:35
 */

namespace App\Services;


use App\Http\Requests\PatientsCreateRequest;
use App\Http\Requests\PatientsUpdateRequest;
use App\Repositories\LogRepository;
use App\Repositories\PatientsRepository;
use App\Validators\PatientsValidator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Class PatientService
 *
 * @author Saulo Vinícius
 * @since 14/07/2017
 * @package App\Services
 */
class PatientService
{

    /**
     * @var PatientsRepository
     */
    protected $repository;

    /**
     * @var PatientsValidator
     */
    protected $validator;

    /**
     * @var LogRepository
     */
    protected $log;

    /**
     * PatientService constructor.
     *
     * @param PatientsRepository $repository
     * @param PatientsValidator $validator
     * @param LogRepository $log
     */
    public function __construct(PatientsRepository $repository, PatientsValidator $validator, LogRepository $log)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->log = $log;
    }

    /**
     * @param PatientsCreateRequest $request
     *
     * @return array
     */
    public function store(PatientsCreateRequest $request)
    {
        try {

            $data = $request->all();

            $data['cpf'] = !empty($data['cpf']) ? $data['cpf'] : null;
            $data['rg'] = !empty($data['rg']) ? $data['rg'] : null;

            $data['birthday_date'] = !empty($data['birthday_date']) ? date('Y-m-d',
                strtotime($data['birthday_date'])) : null;

            if (!empty(session('photo'))) {
                $data['photo'] = session('photo');
            }

            $this->validator->with($data)->passesOrFail(ValidatorInterface::RULE_CREATE);

            $user = $this->repository->create($data);
            $this->repository->updateContacts($data, $user['data']['id']);
            $this->repository->updateDoctors($data, $user['data']['id']);

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
                'message' => 'Ocorreu um erro ao adicionar o paciente.'
            ];
        }
    }

    /**
     * @param PatientsUpdateRequest $request
     * @param $id
     *
     * @return array|bool
     */
    public function update(PatientsUpdateRequest $request, $id)
    {
        try {
            $data = $request->except('level');

            $data['cpf'] = !empty($data['cpf']) ? $data['cpf'] : null;
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
            $this->repository->updateDoctors($data, $id);

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
                'message' => 'Ocorreu um erro ao editar o paciente.'
            ];

        }
    }
}