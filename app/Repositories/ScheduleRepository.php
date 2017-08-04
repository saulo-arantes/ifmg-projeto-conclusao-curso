<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Request;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ScheduleRepository
 * @package namespace App\Repositories;
 */
interface ScheduleRepository extends RepositoryInterface {

	public function getExtraData($id = null);

}
