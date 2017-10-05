<?php

namespace App\Services\DataTables;

use App\Entities\Schedule;
use App\Entities\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Services\DataTable;

/**
 * Class SchedulesDataTable
 *
 * @author  Saulo Vinícius
 * @package App\DataTables
 */
class SchedulesDataTable extends DataTable
{

	public function dataTable()
	{
		return (new EloquentDataTable($this->query()))
			->editColumn('doctor.user.name', function (Schedule $model) {
				return $model->doctor->user->name ?? '<div style="text-align: center">-</div>';
			})->editColumn('patient.name', function (Schedule $model) {
				return $model->patient->name ?? '<div style="text-align: center">-</div>';
			})->editColumn('patient.contacts', function (Schedule $model) {

				if (!empty($model->patient->contacts)) {
					$contactString = '';
					foreach ($model->patient->contacts as $contact) {
						$contactString .= $contact->contactType->name . ' => ' . $contact->description . '<br>';
					}

					return $contactString;
				}

				return '<div style="text-align: center">-</div>';
			})->editColumn('start_at', function (Schedule $model) {
				return date('d/m/Y H:i', strtotime($model->start_at));
			})->editColumn('finish_at', function (Schedule $model) {
				return date('d/m/Y H:i', strtotime($model->finish_at));
			})->setRowAttr([
				'href' =>
					function (Schedule $model) {

						switch ($model['type']) {
							case 0:
								return '/' . User::getUserMiddleware() . '/schedules/' . $model->id . '/edit/appointment';

							case 1:
								return '/' . User::getUserMiddleware() . '/schedules/' . $model->id . '/edit/scheduling';
						}
					},
			])->editColumn('type', function (Schedule $model) {
				if ($model['type'] == 0) {
					if ($model['finish_at'] < Carbon::now()) {

						return '<span class="label label-sm label-default center-block" style="color: white; text-align: center;">Consulta</span>';
					}

					return '<span class="label label-sm label-info center-block" style="color: white; text-align: center;">Consulta</span>';
				} elseif ($model['type'] == 1) {
					if ($model['finish_at'] < Carbon::now()) {

						return '<span class="label label-sm label-default center-block" style="color: white; text-align: center;">Compromisso</span>';
					}

					return '<span class="label label-sm label-success center-block" style="color: white; text-align: center;">Compromisso</span>';
				}

				return '<span class="label label-sm label-default center-block" style="color: white; text-align: center;">???</span>';
			})->editColumn('status', function (Schedule $model) {
				if ($model['type'] == 0) {
					if ($model->status == Schedule::CREATED) {
						return '<span class="label label-sm label-info center-block" style="color: white; text-align: center;">Criado</span>';
					} elseif ($model->status == Schedule::CONFIRMED) {
						return '<span class="label label-sm label-warning center-block" style="color: white; text-align: center;">Confirmado</span>';
					} elseif ($model->status == Schedule::ACCOMPLISHED) {
						return '<span class="label label-sm label-success center-block" style="color: white; text-align: center;">Realizado</span>';
					} elseif ($model->status == Schedule::CANCELED) {
						return '<span class="label label-sm label-default center-block" style="color: white; text-align: center;">Cancelado</span>';
					} else {
						return '<span class="label label-sm label-warning center-block" style="color: white; text-align: center;">Desconhecido</span>';
					}
				} elseif ($model['type'] == 1) {

					return '<span class="label center-block" style="color: white; text-align: center;">-</span>';
				}
			})->escapeColumns([0]);
	}

	/**
	 * Get the query object to be processed by dataTables.
	 *
	 * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Query\Builder|\Illuminate\Support\Collection
	 */
	public function query()
	{
		$query = Schedule::with([
			'doctor.user',
			'patient',
			'patient.contacts'
		])->select()
		  ->addSelect(DB::raw('DATEDIFF(start_at, CURDATE()) AS diff'))
		  ->orderByRaw('CASE WHEN diff < 0 THEN 1 ELSE 0 END, diff')
		  ->orderBy('start_at');

		return $this->applyScopes($query);
	}

	/**
	 * Optional method if you want to use html builder.
	 *
	 * @return \Yajra\DataTables\Html\Builder
	 */
	public function html()
	{
		return $this->builder()
		            ->columns($this->getColumns())
		            ->setTableAttributes([
			            'class' => 'table table-bordered table-hover',
			            'style' => 'width: 100%;'
		            ])->parameters($this->getBuilderParameters())->parameters([
				'dom'          => 'Bfrtlip',
				'responsive'   => true,
				'scrollX'      => true,
				'language'     => ['url' => '/assets/global/plugins/datatables/DataTables-1.10.12/portuguese-brasil.json'],
				'lengthMenu'   => [
					[
						5,
						10,
						15,
						20,
						100
					],
					[
						5,
						10,
						15,
						20,
						100
					]
				],
				'pageLength'   => 10,
				'buttons'      => [
					'export',
					'print',
					'reload',
				],
				'drawCallback' => "function () {
                    var table = $('#dataTableBuilder');
                    
                    $('#dataTableBuilder tbody tr').click(function () {
                        window.location = $(this).attr('href');
                        return false;
                    })
                }"
			]);
	}

	/**
	 * Get columns.
	 *
	 * @return array
	 */
	protected function getColumns()
	{
		return [
			'type'             => [
				'title'      => 'Tipo',
				'orderable'  => false,
				'searchable' => false
			],
			'description'      => [
				'title'     => 'Descrição',
				'orderable' => false,
			],
			'doctor.user.name' => [
				'title'     => 'Médico',
				'orderable' => false,
			],
			'patient.name'     => [
				'title'     => 'Paciente',
				'style'     => 'width=50px',
				'orderable' => false,
			],
			'patient.contacts' => [
				'title'      => 'Contato',
				'orderable'  => false,
				'searchable' => false,
			],
			'start_at'         => [
				'title'     => 'Início',
				'orderable' => false,
			],
			'finish_at'        => [
				'title'     => 'Fim',
				'orderable' => false,
			],
			'status'           => [
				'title'      => 'Situação',
				'searchable' => false,
				'orderable' => false,
			],
		];
	}

	/**
	 * Get filename for export.
	 *
	 * @return string
	 */
	protected function filename()
	{
		return 'schedules_' . time();
	}
}