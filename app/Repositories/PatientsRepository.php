<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface PatientsRepository
 * @package namespace App\Repositories;
 */
interface PatientsRepository extends RepositoryInterface
{
    public function getExtraData($id = null): array;

    /**
     * Update the contacts of an patient.
     *
     * @param $data
     * @param $id
     *
     * @return array|bool
     */
    public function updateContacts($data, $id);
}
