<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface PatientsRepository
 * @package namespace App\Repositories;
 */
interface PatientsRepository extends RepositoryInterface
{
    public function getExtraData(): array;
}
