<?php

namespace App\Repositories;

use App\Entities\ContactType;
use App\Entities\Doctor;
use App\Entities\DoctorPatient;
use App\Entities\Patient;
use App\Entities\PatientContact;
use App\Entities\State;
use App\Entities\User;
use App\Presenters\PatientsPresenter;
use App\Validators\PatientsValidator;
use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class PatientsRepositoryEloquent
 *
 * @author Saulo Vinícius
 * @package namespace App\Repositories;
 */
class PatientsRepositoryEloquent extends BaseRepository implements PatientsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Patient::class;
    }

    /**
     * Specify Validator class name
     *
     * @return mixed
     */
    public function validator()
    {

        return PatientsValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter()
    {
        return PatientsPresenter::class;
    }

    /**
     * This method return extra arrays to use in views.
     *
     * @param $id
     *
     * @return array
     */
    public function getExtraData($id = null): array
    {
        $extraData['states'] = State::all();
        $extraData['contact_types'] = ContactType::all();
        $extraData['doctors'] = Doctor::with('user')->get();
        $extraData['middleware'] = User::getUserMiddleware();

        if (!empty($id)) {
            $extraData['doctor_patient'] = (new DoctorPatient)->where('patient_id', $id)->get();
            $patientDoctors = [];
            foreach ($extraData['doctor_patient'] as $doctors) {
                $patientDoctors[] = $doctors->doctor_id;
            }
            $extraData['doctor_patient'] = $patientDoctors;
            $data = $this->find($id);
            if (!empty($data['data']['city']['data']['id'])) {
                $extraData['cities'] = (new State)->find($data['data']['city']['data']['state']['id'])->cities;
            }
            if (!empty($data['data']['naturalness']['data']['id'])) {
                $extraData['naturalness'] = (new State)->find($data['data']['naturalness']['data']['state']['id'])->cities;
            }
        }

        if (Auth::user()->level == User::DOCTOR) {
            $doctor = (new Doctor)->where('user_id', Auth::user()->id)->first();
            $extraData['doctor_id'] = $doctor->id;
        }

        return $extraData;
    }

    /**
     * Update the contacts of a patient.
     *
     * @param $data
     * @param $id
     *
     * @return array|bool
     */
    public function updateContacts($data, $id)
    {
        if (!empty($data['contact_type_id']) && !empty($data['description'])) {

            # Check if patient pass the same quantity of contacts and contact types
            if (count($data['contact_type_id']) == count($data['description'])) {

                $contacts = (new PatientContact)->where('patient_id', $id)->get()->toArray();
                foreach ($contacts as $contact) {
                    PatientContact::destroy($contact['id']);
                }

                $i = 0;
                foreach ($data['contact_type_id'] as $contact) {
                    if (!empty($data['description'][$i])) {
	                    (new PatientContact)->create([
                            'patient_id'      => $id,
                            'contact_type_id' => $contact,
                            'description'     => $data['description'][$i]
                        ]);
                    }
                    $i++;
                }

                return true;
            }

            return [
                'error'   => true,
                'message' => 'Adicione um contato'
            ];
        }

        return [
            'error'   => true,
            'message' => 'Adicione um contato'
        ];
    }

    /**
     * Update the doctors of a patient
     *
     * @param $data
     * @param $id
     *
     * @return array|bool
     */
    public function updateDoctors($data, $id)
    {
        if (!empty($data['doctors'])) {

            $doctorPatients = (new DoctorPatient)->where('patient_id', $id)->get()->toArray();
            foreach ($doctorPatients as $doctorPatient) {
                DoctorPatient::destroy($doctorPatient['id']);
            }
			#dd($data);
            foreach ($data['doctors'] as $doctor) {
	            (new DoctorPatient)->create([
                    'patient_id' => $id,
                    'doctor_id'  => $doctor
                ]);
            }

            return true;
        }

        return [
            'error'   => true,
            'message' => 'Adicione um Médico'
        ];
    }

}
