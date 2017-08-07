<?php

namespace App\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ScheduleRepository
 *
 * @author Saulo Vinícius
 * @package namespace App\Repositories;
 */
interface ScheduleRepository extends RepositoryInterface
{

    public function getExtraData($id = null);

}
