<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface ScheduleRepository
 *
 * @author  Saulo Vinícius
 * @package namespace App\Repositories;
 */
interface ScheduleRepository extends RepositoryInterface
{

    public function getExtraData($id = null);

    /**
     * Return events by date range.
     *
     * @param Request $request
     *
     * @return array
     */
    public function getSchedulesForCalendar(Request $request);

}
