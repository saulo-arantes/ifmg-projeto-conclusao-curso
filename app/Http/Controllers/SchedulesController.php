<?php

namespace App\Http\Controllers;

use App\Entities\User;
use App\Http\Requests\ScheduleCreateRequest;
use App\Http\Requests\ScheduleUpdateRequest;
use App\Repositories\ScheduleRepository;
use App\Services\DataTables\SchedulesDataTable;
use App\Services\ScheduleService;
use Illuminate\Http\Request;

/**
 * Class AuditsController
 *
 * @author  Saulo Vinícius
 * @since   19/07/2017
 * @package App\Http\Controllers
 */
class SchedulesController extends Controller
{

    protected $repository;
    protected $service;

    /**
     * SchedulesController constructor.
     *
     * @param ScheduleRepository $repository
     * @param ScheduleService $service
     */
    public function __construct(ScheduleRepository $repository, ScheduleService $service)
    {
        $this->repository = $repository;
        $this->service = $service;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createAppointment()
    {
        $extraData = $this->repository->getExtraData();

        return view(User::getUserMiddleware() . '.schedules.create.appointment', compact('extraData'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createScheduling()
    {
        $extraData = $this->repository->getExtraData();

        return view(User::getUserMiddleware() . '.schedules.create.scheduling', compact('extraData'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function calendar()
    {
        $extraData['middleware'] = User::getUserMiddleware();

        return view($extraData['middleware'] . '.schedules.list-calendar', compact('schedules'), compact('extraData'));
    }

    /**
     * Return events by date range.
     *
     * @param Request|Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function calendarAjax(Request $request)
    {
        $schedules = $this->repository->getSchedulesForCalendar($request);

        return response()->json($schedules);
    }

    /**
     * Display a listing of the resource.
     *
     * @param SchedulesDataTable $dataTable
     *
     * @return \Illuminate\Http\JsonResponse|\Illuminate\View\View
     */
    public function index(SchedulesDataTable $dataTable)
    {
        return $dataTable->render(User::getUserMiddleware() . '.schedules.list');
    }

    public function store(ScheduleCreateRequest $request)
    {
        $resultFromStoreSchedule = $this->service->store($request->all());

        if (!empty($resultFromStoreSchedule['error'])) {
            alert()->error($resultFromStoreSchedule['message'], 'Erro :(')->persistent('Fechar');

            return back()->withInput();
        }

        alert()->success('Agendamento adicionado com sucesso!', 'Feito :)');

        return redirect('/' . User::getUserMiddleware() . '/schedules');
    }

    public function edit($id)
    {
	    $extraData = $this->repository->getExtraData();
        $schedule = $this->repository->find($id);
        $month_ptbr = array(
            'Jan' => 'Janeiro',
            'Feb' => 'Fevereiro',
            'Mar' => 'Março',
            'Apr' => 'Abril',
            'May' => 'Maio',
            'Jun' => 'Junho',
            'Jul' => 'Julho',
            'Aug' => 'Agosto',
            'Sep' => 'Setembro',
            'Oct' => 'Outubro',
            'Nov' => 'Novembro',
            'Dec' => 'Dezembro'
        );
        $schedule['data']['start_at'] = strtr(date('d M Y - h:i', strtotime($schedule['data']['start_at'])), $month_ptbr);
        $schedule['data']['finish_at'] = strtr(date('d M Y - h:i', strtotime($schedule['data']['finish_at'])), $month_ptbr);

        return view(User::getUserMiddleware() . '.schedules.edit', compact('schedule'), compact('extraData'));
    }

    public function update(ScheduleUpdateRequest $request, $id)
    {

        $resultFromUpdateSchedule = $this->service->update($request->all(), $id);

        if (!empty($resultFromUpdateSchedule['error'])) {
            alert()->error($resultFromUpdateSchedule['message'], 'Erro :(')->persistent('Fechar');

            return back()->withInput();
        }

        alert()->success('Agendamento atualizado com sucesso!', 'Feito :)');

        return back()->withInput();
    }

}
