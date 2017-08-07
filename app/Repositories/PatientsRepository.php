<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface PatientsRepository
 * @package namespace App\Repositories;
 */
interface PatientsRepository extends RepositoryInterface
{

    /**
     * @param null $id
     *
     * @return array
     */
    public function getExtraData($id = null): array;

    /**
     * Update the contacts of a patient.
     *
     * @param $data
     * @param $id
     *
     * @return array|bool
     */
    public function updateContacts($data, $id);

    /**
     * Update the doctors of a patient.
     *
     * @param $data
     * @param $id
     *
     * @return mixed
     */
    public function updateDoctors($data, $id);
}
