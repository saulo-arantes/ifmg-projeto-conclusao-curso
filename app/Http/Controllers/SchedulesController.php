<?php

namespace App\Http\Controllers;

use App\Entities\User;
use App\Http\Requests\ScheduleCreateRequest;
use App\Http\Requests\ScheduleUpdateRequest;
use App\Repositories\ScheduleRepository;
use App\Services\DataTables\SchedulesDataTable;
use App\Services\ScheduleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

/**
 * Class AuditsController
 *
 * @author  Saulo Vinícius
 * @since   19/07/2017
 * @package App\Http\Controllers
 */
class SchedulesController extends Controller
{

    /**
     * @var ScheduleRepository
     */
    protected $repository;
    /**
     * @var ScheduleService
     */
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
        Log::debug($schedules);
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  ScheduleCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ScheduleCreateRequest $request, $otherController = null)
    {


        $resultFromStoreSchedule = $this->service->store($request, $otherController);

        if (!empty($otherController)) {
            return $resultFromStoreSchedule;
        }

        if (!empty($resultFromStoreSchedule['error'])) {
            alert()->error($resultFromStoreSchedule['message'], 'Erro :(')->persistent('Fechar');

            return back()->withInput();
        }

        alert()->success('Agendamento adicionado com sucesso!', 'Feito :)');

        return redirect('/' . User::getUserMiddleware() . '/schedules');
    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $schedule = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $schedule,
            ]);
        }

        return view('schedules.show', compact('schedule'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
	    $extraData = $this->repository->getExtraData();
        $schedule = $this->repository->find($id);
        $month_ptbr = array(
            'Jan' => 'Janeiro',
            'Feb' => 'Fevereiro',
            'Mar' => 'Marco',
            'Apr' => 'Abril',
            'May' => 'Maio',
            'Jun' => 'Junho',
            'Jul' => 'Julho',
            'Aug' => 'Agosto',
            'Nov' => 'Novembro',
            'Sep' => 'Setembro',
            'Oct' => 'Outubro',
            'Dec' => 'Dezembro'
        );
        $schedule['data']['start_at'] = strtr(date('d M Y - h:i', strtotime($schedule['data']['start_at'])), $month_ptbr);
        $schedule['data']['finish_at'] = strtr(date('d M Y - h:i', strtotime($schedule['data']['finish_at'])), $month_ptbr);

        return view(User::getUserMiddleware() . '.schedules.edit', compact('schedule'), compact('extraData'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  ScheduleUpdateRequest $request
     * @param  string $id
     *
     * @return Response
     */
    public function update(ScheduleUpdateRequest $request, $id)
    {

        $resultFromUpdateSchedule = $this->service->update($request, $id);

        if (!empty($otherController)) {
            return $resultFromUpdateSchedule;
        }

        if (!empty($resultFromUpdateSchedule['error'])) {
            alert()->error($resultFromUpdateSchedule['message'], 'Erro :(')->persistent('Fechar');

            return back()->withInput();
        }

        alert()->success('Agendamento atualizado com sucesso!', 'Feito :)');

        return back()->withInput();
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Schedule deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Schedule deleted.');
    }
}
